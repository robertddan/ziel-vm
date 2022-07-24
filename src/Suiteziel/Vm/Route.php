<?php
namespace App\Suiteziel\Vm;


//use App\Suiteziel\Vm;
use App\Suiteziel\Vm\Opcodes;
use App\Suiteziel\Vm\Memory;
use App\Suiteziel\Vm\Stack;
use App\Suiteziel\Vm\State;
use App\Suiteziel\Vm\Storage;

class Route
{

	public $i_pc;
	public $aHex;
		
	public $oOpcodes;
	public $oMemory;
	public $oStack;
	public $oState;
	public $oStorage;
		
	public $oAddress;
	public $oDatabase;
	public $oDiamonds;
	public $oSession;
	public $oUtils;
		
	function __construct() {}
		
	public function init ($oEvent) :bool {
		if (!$this->init_classes_($oEvent)) die('$this->init_classes');
		if (!$this->init_variables_()) die('$this->init_variables');
		return true; 
	}
		
	public function init_classes_ ($oEvent) :bool {
		
		$this->oOpcodes = new Opcodes();
		$this->oMemory = new Memory();
		$this->oStack = new Stack();
		$this->oState = new State();
		$this->oStorage = new Storage();
		
		$this->oAddress = $oEvent->oAddress;
		$this->oDatabase = $oEvent->oDatabase;
		$this->oDiamonds = $oEvent->oDiamonds;
		$this->oSession = $oEvent->oSession;
		$this->oUtils = $oEvent->oUtils;
		
		return true;
	}
	
	public function init_variables_ () :bool {
		$this->i_pc = 0;
		$this->aHex = $this->oDiamonds->aHex;
		
		return true;
	}
	
	public function save_session () :bool {
		$aaSession = array(
			'oAddress' => $this->oAddress->aAddress,
			'oDatabase' => $this->oDatabase->sPath,
			'oDiamonds' => $this->oDiamonds->aHex,
			'oSession' => $this->oSession->aData,
		);
		return true;
	}
	
	public function implement () :bool {
		if (empty($this->aHex)) die('Route->implement');
		//var_dump($this->oAddress);
		
		var_dump(strlen('11')/8);
/*
		$this->aHex = array(
			96,128,96,64,82,52,128,21,97,0,16,87,96,0,128,253,91,80,96,200,128,97,0,31,96,0,57,96,0,243,254,96,128,96,64,82,52,128,21,96

			//0x56, //JUMP
			0x60, 0x3, //PUSH1
			0x60, 0x8, //PUSH1
			0x57, //JUMPI
			0x30, //ADDRESS
			0x30, //ADDRESS
			0x30, //ADDRESS
			0x30, //ADDRESS
			0x5b, //JUMPDEST
			//0x58, //PC
			0x30, //ADDRESS
			
			0x00, //STOP
			
			0x60, 33, //PUSH1
			0x60, 34, //PUSH1
			0x55, //SSTORE
			
			0x33, //CALLER
			0x34, //CALLVALUE
			0x35, //CALLDATALOAD
			0x36, //CALLDATASIZE
			0x37, //CALLDATACOPY
			0x38, //CODESIZE
			0x39, //CODECOPY
			
			//Block Information
			0x40, //BLOCKHASH
			0x41, //COINBASE
			0x42, //TIMESTAMP
			0x43, //NUMBER
			0x44, //DIFFICULTY
			0x45, //GASLIMIT
			
			0x31, //BALANCE
			0x3b, //EXTCODESIZE
			0x3c, //EXTCODECOPY
			
			0x54, //SLOAD
			0x55, //SSTORE
			
			//Stack, Memory, Storage and Flow Operations
			0x50, //POP
			0x5a, //GAS
			
			// f0s: System operations
			0xf0, //CREATE
			0xf1, //CALL
			0xf2, //CALLCODE
			0xf3, //RETURN
			0xf4, //DELEGATECALL
			0xfe, //INVALID
			0xff, //SELFDESTRUCT
			
			0x00, //STOP

		);
*/

		if (!$this->oOpcodes->hex_set($this->aHex)) die('oOpcodes->hex_set');


		for ($i = 0; $i<count($this->aHex); $i++) {
				
			$sHex = $this->aHex[$i];
			
			if (!$this->oOpcodes->initiate($i, $sHex)) die('oOpcodes->initiate'); // view
			if (!$this->oOpcodes->describe($i, $sHex)) die('oOpcodes->describe');

		}
		
		print(PHP_EOL);print(PHP_EOL);
		print(PHP_EOL);print(PHP_EOL);print(PHP_EOL);

		var_dump('------------------------------------------------------------------------------');
		

		
		
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
	
			
			if (!$this->oStack->positioning($aa_p)) die('oStack->positioning');
			if (!$this->oState->positioning($aa_p)) die('oState->positioning');
			if (!$this->oMemory->positioning($aa_p)) die('oMemory->positioning');
			if (!$this->oStorage->positioning($aa_p)) die('oStorage->positioning');
			
			
			$i = $aa_p[3];
			$this->oStack->aaStack = $aa_p[4];
			
			
			//var_dump($this->oStack->aaStack);
			if ($aa_p[3] == 'STOP') break; //array()
			$i_opargs = count($aArguments);
			
			
		}
		
		print(PHP_EOL);print(PHP_EOL);
		print(PHP_EOL);print(PHP_EOL);print(PHP_EOL);
		var_dump('$this->oMemory->aaMemory');
		var_dump("Memory::". implode("::", $this->oMemory->aaMemory[1234]));
		var_dump('$this->oStack->aaStack');
		var_dump("Stack::". implode("::", $this->oStack->aaStack));
		var_dump('$this->oStorage->aaStorage');
		//var_dump("Storage::". implode("::", $this->oStorage->aaStorage));
		var_dump($this->oStorage->aaStorage);
		
		if (!$this->save_session()) die('$this->save_session');
		return true;
	}

}

?>