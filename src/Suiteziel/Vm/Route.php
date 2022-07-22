<?php
namespace App\Suiteziel\Vm;


use App\Suiteziel\Org\Diamonds;
use App\Suiteziel\Vm;
use App\Suiteziel\Vm\Opcodes;
use App\Suiteziel\Vm\Memory;
use App\Suiteziel\Vm\Stack;
use App\Suiteziel\Vm\State;
use App\Suiteziel\Vm\Storage;

class Route extends Vm
{

	public $i_pc;
	public $aHex;
	public $oOpcodes;
	public $oMemory;
	public $oStack;
	public $oState;

	function __construct() {
		$this->i_pc = 0;
		$this->oOpcodes = new Opcodes();
		$this->oMemory = new Memory();
		$this->oStack = new Stack();
		$this->oState = new State();
		$this->oStorage = new Storage();
	}

	public function set_hex() :bool {
		$this->aHex = Diamonds::$_aHex;
		return true;
	}

	public function implement () :bool {
		//if (!$this->set_hex() && empty($this->aHex)) die('Route->implement');

		$this->aHex = array(
			//0x60, 32, 0x60, 33, 0x00, //STOP

			//0x56, //JUMP
			//0x57, //JUMPI
			//0x5b, //JUMPDEST
			//0x58, //PC
			0x30, //ADDRESS
			
			0x60, 33, //PUSH1
			0x53, //MSTORE8
			0x59, //MSIZE
			0x00, //STOP
			
			//0x54, //SLOAD
			//0x55, //SSTORE
			
			//0x3a, //GASPRICE
			//0x31, //BALANCE
			//0x32, //ORIGIN
			
			//0x33, //CALLER
			//0x34, //CALLVALUE
			//0x35, //CALLDATALOAD
			//0x36, //CALLDATASIZE
			//0x37, //CALLDATACOPY
			
			//0x38, //CODESIZE
			//0x39, //CODECOPY
			
			//0x3b, //EXTCODESIZE
			//0x3c, //EXTCODECOPY
			
			//Block Information
			//0x40, //BLOCKHASH
			//0x41, //COINBASE
			//0x42, //TIMESTAMP
			//0x43, //NUMBER
			//0x44, //DIFFICULTY
			//0x45, //GASLIMIT
			
			//Stack, Memory, Storage and Flow Operations
			//0x50, //POP
			//0x5a, //GAS
			
			// f0s: System operations
			//0xf0, //CREATE
			//0xf1, //CALL
			//0xf2, //CALLCODE
			//0xf3, //RETURN
			//0xf4, //DELEGATECALL
			//0xfe, //INVALID
			//0xff, //SELFDESTRUCT
		);
		
		if (!$this->oOpcodes->hex_set($this->aHex)) die('oOpcodes->hex_set');
///return var_dump($this->aHex);
		$i_opargs = 0;
		//foreach ($this->aHex as $k => $sHex) {
		for ($i = 0; $i<count($this->aHex); $i++) {
			$this->i_pc = $i;
			$sHex = $this->aHex[$i];
			
			if ($i_opargs !== 0) { $i_opargs--; continue; }
			
			if (!$this->oOpcodes->initiate($i, $sHex)) die('oOpcodes->initiate'); // view
			if (!$this->oOpcodes->describe($i, $sHex)) die('oOpcodes->describe');
			
			$aArguments = $this->oOpcodes->aArguments;
			$iDelta = $this->oOpcodes->aaOpcodes[$sHex][1];
			
$aa_p = array(
	$sHex,
	$aArguments,
	$iDelta,
	$this->i_pc,
	$this->oStack->aaStack
);
			
			if (!$this->oStack->positioning($aa_p)) die('oStack->positioning'); //$i, $sHex, $aArguments, $iDelta)) die('oStack->positioning');
			
			
			//if (!$this->oStack->positioning($i, $sHex, $aArguments, $iDelta)) die('oStack->positioning');
			if (!$this->oMemory->positioning($aa_p)) die('oMemory->positioning');
			if (!$this->oStorage->positioning($aa_p)) die('oStorage->positioning');
			if (!$this->oState->positioning($aa_p)) die('oState->positioning');
			
			
			$i = $aa_p[3];
			$this->oStack->aaStack = $aa_p[4];
			
			
			//var_dump($this->oStack->aaStack);
			if ($aa_p[3] == 'STOP') break;
			$i_opargs = count($aArguments);
			/**/
		}
		
		print(PHP_EOL);
		var_dump('$this->oMemory->aaMemory');
		//var_dump($this->oMemory->aaMemory[1234]);
		var_dump("Memory::". implode("::", $this->oMemory->aaMemory[1234]));
		var_dump('$this->oStack->aaStack');
		//var_dump($this->oStack->aaStack);
		var_dump("Stack::". implode("::", $this->oStack->aaStack));
		return true;
	}

}

?>