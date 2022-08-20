<?php
namespace App\Suiteziel\Vm;


use App\Suiteziel\VM\Stack;
use App\Suiteziel\Vm\Route;

class Memory
{
	public static $aaMemory;
	public $aHes;

	public function __construct () {
		self::$aaMemory = array();
	}
	
	public function shift_left ($sHex) {
		return "0x". str_pad($sHex, 64, 0, STR_PAD_LEFT);
	}
    		
	public function shift_right ($sHex) {
		return "0x". str_pad($sHex, 64, 0, STR_PAD_RIGHT);
	}

	public function positioning(&$i_pc, $sHex) {
    
    $sDec = hexdec($sHex);
    $aArguments = Opcodes::$aArguments;
    $iDelta = Opcodes::$aaOpcodes[$sDec][1];

		switch ($sDec) {
			case 0x39:
				$a_e = array_splice(Stack::$aaStack, 0, $iDelta);

        foreach($a_e as &$s_x) $s_x = hexdec($s_x);
				#print(PHP_EOL);
        #print("sHexDec::". implode(" ", $a_e));

        $this->aHex = Route::$_aHex;
				$aCopyCode1 = array_fill(0, $a_e[2], '0x00');
				$aCopyCode2 = array_slice($this->aHex, $a_e[1], ($a_e[1] + $a_e[2]));
				$aCopyCode = array_replace($aCopyCode1, $aCopyCode2);
				$iKeyStart = base_convert($a_e[0], 16, 10);
				if (!isset(self::$aaMemory[$iKeyStart])) die('CODECOPY');
				foreach($aCopyCode1 as $__k => $sHex){
					self::$aaMemory[$__k] = $aCopyCode[$__k];
				}

/*
	destOffset: byte offset in the memory where the result will be copied.
	offset: byte offset in the code to copy.
	size: byte size to copy.
*/
//var_dump($a_s);
				//$a_m = self::$aaMemory[$a_s[0]];
				//array_unshift(Stack::$aaStack, $a_m);
				//var_dump("Memory::". implode("::", self::$aaMemory));
				#print(PHP_EOL);
				#print("Stack::". implode("::", Stack::$aaStack));
			break; //CODECOPY
			case 0x51:
				$a_s = array_splice(Stack::$aaStack, 0, $iDelta);
				$a_m = self::$aaMemory[$a_s[0]];
				array_unshift(Stack::$aaStack, $a_m);
				//var_dump("Memory::". implode("::", self::$aaMemory));
				#print(PHP_EOL);
				#print("Stack::". implode("::", Stack::$aaStack));
			break; //MLOAD
			case 0x52:
				
				$a_e = array_splice(Stack::$aaStack, 0, $iDelta);
        foreach($a_e as &$s_x) $s_x = hexdec($s_x);
				#print(PHP_EOL);
        #print("sHexDec::". implode(" ", $a_e));
				$i=32;
				while ($i<$a_e[0]) $i=32+$i; 
				$aMemory = array_fill(0, $i, 0);
				
				//$hex_i = base_convert($a_e[0], 10, 16);
				$aMemory[$a_e[0]] = dechex($a_e[1]);
				self::$aaMemory = $aMemory;
				//var_dump("Memory::". implode("::", $aMemory));
				
				print("Stack::". implode("::", Stack::$aaStack));
        print(PHP_EOL);
			break; //MSTORE
			
			case 0x53:
				$a_e = array_splice(Stack::$aaStack, 0, $iDelta); 
				$i=32;
				//$hex_i = base_convert($a_e[0], 10, 16);
				while ($i<$a_e[0]) $i=32+$i; 
				$aMemory = array_fill(0, $i, 0);
				$aMemory[$a_e[0]] = $a_e[1];
				self::$aaMemory = $aMemory;
				//var_dump("Memory::". implode("::", $aMemory));
			break; //MSTORE8
			case 0x59:
				array_unshift(Stack::$aaStack, (count(self::$aaMemory)/3.2));
				//var_dump("Memory::". implode("::", self::$aaMemory));
				//... Linear Diophantine Equations
				// ...congruence equation (mod 8 or 9)
				// .. 8 ≡ 23 (mod 5)...which is read, “8 is congruent to 23 modulo 5” (or just “mod 5”), by Levin (2019). 
				//References
				//Levin, O. (2019). Discrete mathematics: An open introduction (3 edition). CreateSpace Independent Publishing Platform. http://discrete.openmathbooks.org/pdfs/dmoi-tablet.pdf

			break; //MSIZE
			default: return true; break;
		}
		
		/**/
		#print(PHP_EOL);
		print("Memory::". implode("::", self::$aaMemory));
		
		return true;
	}
}
?>