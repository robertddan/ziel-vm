<?php
namespace App\Suiteziel\Vm;


use App\Suiteziel\Vm\Route;

class Stack extends Route
{ 
	public $i_sp; //stack pointer
	public $aaStack;
		
	public function __construct () {
		$this->i_sp = 0;
		$this->aaStack = array();
	}
/*
	public function __construct () {

	}
	
$sHex,
$aArguments,
$iDelta,
$this->i_pc,
$this->oStack->aaStack,
*/
	public function positioning(&$aa_p) { //$i_k = null, $sHex = null, $aArguments = null, $iDelta = null) {
		list($sHex, $aArguments, $iDelta, $i_pc, &$aaStack) = $aa_p;

		switch ($sHex) {
			case 0x00: return 1; break; //STOP
			case 0x01:
				$a_e = array_splice($this->aaStack, 0, $iDelta);
				array_unshift($this->aaStack, array_sum($a_e));
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //ADD
			case 0x02:
				$a_e = array_splice($this->aaStack, 0, $iDelta);
				array_unshift($this->aaStack, array_product($a_e));
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //MUL
			case 0x03:
				$a_e = array_splice($this->aaStack, 0, $iDelta);
				array_unshift($this->aaStack, ($a_e[0] - $a_e[1]));
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SUB
			case 0x04:
				$a_e = array_splice($this->aaStack, 0, $iDelta);
				array_unshift($this->aaStack, ($a_e[0] / $a_e[1]));
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //DIV
			case 0x05: 
				$a_e = array_splice($this->aaStack, 0, $iDelta);
				array_unshift($this->aaStack, ($a_e[0] / $a_e[1]));
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SDIV
			case 0x06: 
				$a_e = array_splice($this->aaStack, 0, $iDelta);
				if ($a_e[1] == 0) array_unshift($this->aaStack, 0);
				else array_unshift($this->aaStack, ($a_e[0] % $a_e[1]));
				var_dump(implode("::", $this->aaStack));
			break; //MOD
			case 0x07: 
				$a_e = array_splice($this->aaStack, 0, $iDelta);
				if ($a_e[1] == 0) array_unshift($this->aaStack, 0);
				else array_unshift($this->aaStack, ($a_e[0] % $a_e[1]));
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SMOD
			case 0x08: 
				
	/*
				var_dump(array(
					$this->aaStack,
					'delta',
					$iDelta,
					count($this->aaStack)
				));
	*/
				$a_e = array_splice($this->aaStack, 0, $iDelta);
				if ($a_e[2] == 0) array_unshift($this->aaStack, 0);
				else array_unshift($this->aaStack, ($a_e[0] + ($a_e[1] % $a_e[2])));
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //ADDMOD
			case 0x09:
				$a_e = array_splice($this->aaStack, 0, $iDelta);
				if ($a_e[2] == 0) array_unshift($this->aaStack, 0);
				else array_unshift($this->aaStack, ($a_e[0] * ($a_e[1] % $a_e[2])));
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //MULMOD
			case 0x0a: 
				$a_e = array_splice($this->aaStack, 0, $iDelta);
				array_unshift($this->aaStack, (pow($a_e[0], $a_e[1])));
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //EXP
			case 0x0b:
			
			break; //SIGNEXTEND
			case 0x10:
				$a_e = array_splice($this->aaStack, 0, $iDelta);
				if ($a_e[0] < $a_e[1]) $i = 1;
				else $i = 0;
				array_unshift($this->aaStack, $i);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //LT
			case 0x11: 
				$a_e = array_splice($this->aaStack, 0, $iDelta);
				if ($a_e[0] > $a_e[1]) $i = 1;
				else $i = 0;
				array_unshift($this->aaStack, $i);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //GT
			case 0x12: // Where all values are treated as two’s complement signed 256-bit integers.
				$a_e = array_splice($this->aaStack, 0, $iDelta);
				if ($a_e[0] < $a_e[1]) $i = 1;
				else $i = 0;
				array_unshift($this->aaStack, $i);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SLT
			case 0x13:
				$a_e = array_splice($this->aaStack, 0, $iDelta);
				if ($a_e[0] > $a_e[1]) $i = 1;
				else $i = 0;
				array_unshift($this->aaStack, $i);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SGT
			case 0x14:
				$a_e = array_splice($this->aaStack, 0, $iDelta);
				if ($a_e[0] == $a_e[1]) $i = 1;
				else $i = 0;
				array_unshift($this->aaStack, $i);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //EQ
			case 0x15:
				$a_e = array_splice($this->aaStack, 0, $iDelta);
				if ($a_e[0] == 0) $i = 1;
				else $i = 0;
				array_unshift($this->aaStack, $i);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //ISZERO
			case 0x16:
				$a_e = array_splice($this->aaStack, 0, $iDelta);
				if ($a_e[0] and $a_e[1]) $i = 1;
				else $i = 0;
				array_unshift($this->aaStack, $i);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //AND
			case 0x17:
				$a_e = array_splice($this->aaStack, 0, $iDelta);
				if ($a_e[0] or $a_e[1]) $i = 1;
				else $i = 0;
				array_unshift($this->aaStack, $i);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //OR
			case 0x18: 
				$a_e = array_splice($this->aaStack, 0, $iDelta);
				if ($a_e[0] xor $a_e[1]) $i = 1;
				else $i = 0;
				array_unshift($this->aaStack, $i);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //XOR
			case 0x19:
				$a_e = array_splice($this->aaStack, 0, $iDelta);
				if ($a_e[0] == 0) $i = 1;
				else $i = 0;
				array_unshift($this->aaStack, $i);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //NOT				
			case 0x1a:
				$a_e = array_splice($this->aaStack, 0, $iDelta);
				for($i = 0; $i < strlen($a_e[1]); $i++) $a_e[0] = ord($a_e[1]);
				array_unshift($this->aaStack, $a_e[0]);
				var_dump(implode("::", $this->aaStack));
				return true;
			break; //BYTE
			case 0x1b:
				$a_e = array_splice($this->aaStack, 0, $iDelta);
				array_unshift($this->aaStack, ($a_e[0] >> $a_e[1]));
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SHL Left shift operation.
			case 0x1c:
				$a_e = array_splice($this->aaStack, 0, $iDelta);
				array_unshift($this->aaStack, ($a_e[0] << $a_e[1]));
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SHR Logical right shift operation.
			case 0x1d:
				$a_e = array_splice($this->aaStack, 0, $iDelta);
				array_unshift($this->aaStack, ($a_e[0] << $a_e[1]));
				var_dump(implode("::", $this->aaStack));
				return true;
			break; //SAR 
//
			case 0x60:
				$sArgument = implode("", $aArguments); /*foreach ($aArguments as $iArgument)*/ array_unshift($this->aaStack, $sArgument);
				return true; 
			break; //PUSH1
			case 0x61:
				$sArgument = implode("", $aArguments); /*foreach ($aArguments as $iArgument)*/ array_unshift($this->aaStack, $sArgument);
				return true; 
			break; //PUSH2
			case 0x62:
				$sArgument = implode("", $aArguments); /*foreach ($aArguments as $iArgument)*/ array_unshift($this->aaStack, $sArgument);
				return true; 
			break; //PUSH3
			case 0x63:
				$sArgument = implode("", $aArguments); /*foreach ($aArguments as $iArgument)*/ array_unshift($this->aaStack, $sArgument);
				return true; 
			break; //PUSH4
			case 0x64:
				$sArgument = implode("", $aArguments); /*foreach ($aArguments as $iArgument)*/ array_unshift($this->aaStack, $sArgument);
				return true; 
			break; //PUSH5
			case 0x65:
				$sArgument = implode("", $aArguments); /*foreach ($aArguments as $iArgument)*/ array_unshift($this->aaStack, $sArgument);
				return true; 
			break; //PUSH6
			case 0x66:
				$sArgument = implode("", $aArguments); /*foreach ($aArguments as $iArgument)*/ array_unshift($this->aaStack, $sArgument);
				return true; 
			break; //PUSH7
			case 0x67:
				$sArgument = implode("", $aArguments); /*foreach ($aArguments as $iArgument)*/ array_unshift($this->aaStack, $sArgument);
				return true; 
			break; //PUSH8
			case 0x68:
				$sArgument = implode("", $aArguments); /*foreach ($aArguments as $iArgument)*/ array_unshift($this->aaStack, $sArgument);
				return true; 
			break; //PUSH9
			case 0x69:
				$sArgument = implode("", $aArguments); /*foreach ($aArguments as $iArgument)*/ array_unshift($this->aaStack, $sArgument);
				return true; 
			break; //PUSH10
			case 0x6a:
				$sArgument = implode("", $aArguments); /*foreach ($aArguments as $iArgument)*/ array_unshift($this->aaStack, $sArgument);
				return true; 
			break; //PUSH11
			case 0x6b:
				$sArgument = implode("", $aArguments); /*foreach ($aArguments as $iArgument)*/ array_unshift($this->aaStack, $sArgument);
				return true; 
			break; //PUSH12
			case 0x6c:
				$sArgument = implode("", $aArguments); /*foreach ($aArguments as $iArgument)*/ array_unshift($this->aaStack, $sArgument);
				return true; 
			break; //PUSH13
			case 0x6d:
				$sArgument = implode("", $aArguments); /*foreach ($aArguments as $iArgument)*/ array_unshift($this->aaStack, $sArgument);
				return true; 
			break; //PUSH14
			case 0x6e:
				$sArgument = implode("", $aArguments); /*foreach ($aArguments as $iArgument)*/ array_unshift($this->aaStack, $sArgument);
				return true; 
			break; //PUSH15
			case 0x6f:
				$sArgument = implode("", $aArguments); /*foreach ($aArguments as $iArgument)*/ array_unshift($this->aaStack, $sArgument);
				return true; 
			break; //PUSH16
			case 0x70:
				$sArgument = implode("", $aArguments); /*foreach ($aArguments as $iArgument)*/ array_unshift($this->aaStack, $sArgument);
				return true; 
			break; //PUSH17
			case 0x71:
				$sArgument = implode("", $aArguments); /*foreach ($aArguments as $iArgument)*/ array_unshift($this->aaStack, $sArgument);
				return true; 
			break; //PUSH18
			case 0x72:
				$sArgument = implode("", $aArguments); /*foreach ($aArguments as $iArgument)*/ array_unshift($this->aaStack, $sArgument);
				return true; 
			break; //PUSH19
			case 0x73:
				$sArgument = implode("", $aArguments); /*foreach ($aArguments as $iArgument)*/ array_unshift($this->aaStack, $sArgument);
				return true; 
			break; //PUSH20
			case 0x74:
				$sArgument = implode("", $aArguments); /*foreach ($aArguments as $iArgument)*/ array_unshift($this->aaStack, $sArgument);
				return true; 
			break; //PUSH21
			case 0x75:
				$sArgument = implode("", $aArguments); /*foreach ($aArguments as $iArgument)*/ array_unshift($this->aaStack, $sArgument);
				return true; 
			break; //PUSH22
			case 0x76:
				$sArgument = implode("", $aArguments); /*foreach ($aArguments as $iArgument)*/ array_unshift($this->aaStack, $sArgument);
				return true; 
			break; //PUSH23
			case 0x77:
				$sArgument = implode("", $aArguments); /*foreach ($aArguments as $iArgument)*/ array_unshift($this->aaStack, $sArgument);
				return true; 
			break; //PUSH24
			case 0x78:
				$sArgument = implode("", $aArguments); /*foreach ($aArguments as $iArgument)*/ array_unshift($this->aaStack, $sArgument);
				return true; 
			break; //PUSH25
			case 0x79:
				$sArgument = implode("", $aArguments); /*foreach ($aArguments as $iArgument)*/ array_unshift($this->aaStack, $sArgument);
				return true; 
			break; //PUSH26
			case 0x7a:
				$sArgument = implode("", $aArguments); /*foreach ($aArguments as $iArgument)*/ array_unshift($this->aaStack, $sArgument);
				return true; 
			break; //PUSH27
			case 0x7b:
				$sArgument = implode("", $aArguments); /*foreach ($aArguments as $iArgument)*/ array_unshift($this->aaStack, $sArgument);
				return true; 
			break; //PUSH28
			case 0x7c:
				$sArgument = implode("", $aArguments); /*foreach ($aArguments as $iArgument)*/ array_unshift($this->aaStack, $sArgument);
				return true; 
			break; //PUSH29
			case 0x7d:
				$sArgument = implode("", $aArguments); /*foreach ($aArguments as $iArgument)*/ array_unshift($this->aaStack, $sArgument);
				return true; 
			break; //PUSH30
			case 0x7e:
				$sArgument = implode("", $aArguments); /*foreach ($aArguments as $iArgument)*/ array_unshift($this->aaStack, $sArgument);
				return true; 
			break; //PUSH31
			case 0x7f:
				$sArgument = implode("", $aArguments); /*foreach ($aArguments as $iArgument)*/ array_unshift($this->aaStack, $sArgument);
				return true; 
			break; //PUSH32
			case 0x80:
				array_unshift($this->aaStack, $this->aaStack[0]);
				//var_dump(implode("::", $this->aaStack));
				return true; 
			break; //DUP1
			case 0x81:
				array_unshift($this->aaStack, $this->aaStack[1]);
				return true; 
			break; //DUP2
			case 0x82:
				array_unshift($this->aaStack, $this->aaStack[2]);
				return true; 
			break; //DUP3
			case 0x83:
				array_unshift($this->aaStack, $this->aaStack[3]);
				return true; 
			break; //DUP4
			case 0x84:
				array_unshift($this->aaStack, $this->aaStack[4]);
				return true; 
			break; //DUP5
			case 0x85:
				array_unshift($this->aaStack, $this->aaStack[5]);
				return true; 
			break; //DUP6
			case 0x86:
				array_unshift($this->aaStack, $this->aaStack[6]);
				return true; 
			break; //DUP7
			case 0x87:
				array_unshift($this->aaStack, $this->aaStack[7]);
				return true; 
			break; //DUP8
			case 0x88:
				array_unshift($this->aaStack, $this->aaStack[8]);
				return true; 
			break; //DUP9
			case 0x89:
				array_unshift($this->aaStack, $this->aaStack[9]);
				return true; 
			break; //DUP10
			case 0x8a:
				array_unshift($this->aaStack, $this->aaStack[10]);
				return true; 
			break; //DUP11
			case 0x8b:
				array_unshift($this->aaStack, $this->aaStack[11]);
				return true; 
			break; //DUP12
			case 0x8c:
				array_unshift($this->aaStack, $this->aaStack[12]);
				return true; 
			break; //DUP13
			case 0x8d:
				array_unshift($this->aaStack, $this->aaStack[13]);
				return true; 
			break; //DUP14
			case 0x8e:
				array_unshift($this->aaStack, $this->aaStack[14]);
				return true; 
			break; //DUP15
			case 0x8f:
				array_unshift($this->aaStack, $this->aaStack[15]);
				return true; 
			break; //DUP16
			case 0x90:
				$s_preview = $this->aaStack[0];
				$this->aaStack[0] = $this->aaStack[1];
				$this->aaStack[1] = $s_preview;
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SWAP1
			case 0x91:
				$s_preview = $this->aaStack[0];
				$this->aaStack[0] = $this->aaStack[2];
				$this->aaStack[2] = $s_preview;
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SWAP2
			case 0x92:
				$s_preview = $this->aaStack[0];
				$this->aaStack[0] = $this->aaStack[3];
				$this->aaStack[3] = $s_preview;
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SWAP3
			case 0x93:
				$s_preview = $this->aaStack[0];
				$this->aaStack[0] = $this->aaStack[4];
				$this->aaStack[4] = $s_preview;
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SWAP4
			case 0x94:
				$s_preview = $this->aaStack[0];
				$this->aaStack[0] = $this->aaStack[5];
				$this->aaStack[5] = $s_preview;
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SWAP5
			case 0x95:
				$s_preview = $this->aaStack[0];
				$this->aaStack[0] = $this->aaStack[6];
				$this->aaStack[6] = $s_preview;
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SWAP6
			case 0x96:
				$s_preview = $this->aaStack[0];
				$this->aaStack[0] = $this->aaStack[7];
				$this->aaStack[7] = $s_preview;
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SWAP7
			case 0x97:
				$s_preview = $this->aaStack[0];
				$this->aaStack[0] = $this->aaStack[8];
				$this->aaStack[8] = $s_preview;
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SWAP8
			case 0x98:
				$s_preview = $this->aaStack[0];
				$this->aaStack[0] = $this->aaStack[9];
				$this->aaStack[9] = $s_preview;
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SWAP9
			case 0x99:
				$s_preview = $this->aaStack[0];
				$this->aaStack[0] = $this->aaStack[10];
				$this->aaStack[10] = $s_preview;
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SWAP10
			case 0x9a:
				$s_preview = $this->aaStack[0];
				$this->aaStack[0] = $this->aaStack[11];
				$this->aaStack[11] = $s_preview;
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SWAP11
			case 0x9b:
				$s_preview = $this->aaStack[0];
				$this->aaStack[0] = $this->aaStack[12];
				$this->aaStack[12] = $s_preview;
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SWAP12
			case 0x9c:
				$s_preview = $this->aaStack[0];
				$this->aaStack[0] = $this->aaStack[13];
				$this->aaStack[13] = $s_preview;
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SWAP13
			case 0x9d:
				$s_preview = $this->aaStack[0];
				$this->aaStack[0] = $this->aaStack[14];
				$this->aaStack[14] = $s_preview;
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SWAP14
			case 0x9e:
				$s_preview = $this->aaStack[0];
				$this->aaStack[0] = $this->aaStack[15];
				$this->aaStack[15] = $s_preview;
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SWAP15
			case 0x9f:
				$s_preview = $this->aaStack[0];
				$this->aaStack[0] = $this->aaStack[16];
				$this->aaStack[16] = $s_preview;
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SWAP16
///
			case 0xa0:
				$a_e = array_splice($this->aaStack, 0, $iDelta);
				array_unshift($this->aaStack, 0);
				//var_dump(implode("::", $this->aaStack));
				return true; 
			break; //LOG0
			case 0xa1:
				$a_e = array_splice($this->aaStack, 0, $iDelta);
				array_unshift($this->aaStack, 0);
				//var_dump(implode("::", $this->aaStack));
				return true; 
			break; //LOG1
			case 0xa2:
				$a_e = array_splice($this->aaStack, 0, $iDelta);
				array_unshift($this->aaStack, 0);
				//var_dump(implode("::", $this->aaStack));
				return true; 
			break; //LOG2
			case 0xa3:
				$a_e = array_splice($this->aaStack, 0, $iDelta);
				array_unshift($this->aaStack, 0);
				//var_dump(implode("::", $this->aaStack));
				return true; 
			break; //LOG3
			case 0xa4:
				$a_e = array_splice($this->aaStack, 0, $iDelta);
				array_unshift($this->aaStack, 0);
				//var_dump(implode("::", $this->aaStack));
				return true; 
			break; //LOG4
///
			case 0x20:
				$a_e = array_splice($this->aaStack, 0, $iDelta);
				$s_sha3 = hash('sha3-256', $a_e[1]);
				array_unshift($this->aaStack, $s_sha3);
				var_dump(implode("::", $this->aaStack));
				return true;
			break; //SHA3
			case 0x30:

				var_dump(implode("::", $this->aaStack));
				return true;
			break; //ADDRESS
			case 0x31: return 1; break; //BALANCE
			case 0x32: return 1; break; //ORIGIN
			case 0x33: return 1; break; //CALLER
			case 0x34: return 1; break; //CALLVALUE
			case 0x35: return 1; break; //CALLDATALOAD
			case 0x36: return 1; break; //CALLDATASIZE
			case 0x37: return 1; break; //CALLDATACOPY
			case 0x38: return 1; break; //CODESIZE
			case 0x39: return 1; break; //CODECOPY
			case 0x3a: return 1; break; //GASPRICE
			case 0x3b: return 1; break; //EXTCODESIZE
			case 0x3c: return 1; break; //EXTCODECOPY
			case 0x40: return 1; break; //BLOCKHASH
			case 0x41: return 1; break; //COINBASE
			case 0x42: return 1; break; //TIMESTAMP
			case 0x43: return 1; break; //NUMBER
			case 0x44: return 1; break; //DIFFICULTY
			case 0x45: return 1; break; //GASLIMIT
			case 0x50: return 1; break; //POP

			case 0x54: return 1; break; //SLOAD
			case 0x55: return 1; break; //SSTORE
			case 0x56: return 1; break; //JUMP
			case 0x57: return 1; break; //JUMPI
			case 0x58: return 1; break; //PC
			case 0x59: return 1; break; //MSIZE
			case 0x5a: return 1; break; //GAS
			case 0x5b: return 1; break; //JUMPDEST
				
			case 0xf0: return 1; break; //CREATE
			case 0xf1: return 1; break; //CALL
			case 0xf2: return 1; break; //CALLCODE
			case 0xf3: return 1; break; //RETURN
			case 0xf4: return 1; break; //DELEGATECALL
			case 0xfe: return 1; break; //INVALID
			case 0xff: return 1; break; //SELFDESTRUCT
///
			default: return true; break;
		}
		return true;
		
		
	}
	
	
	
}

?>