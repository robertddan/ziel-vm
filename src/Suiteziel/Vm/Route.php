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
		$this->aHex = $this->oSession->aData['aHex'];

		if (empty($this->aHex)) die('Route->implement');
		var_dump('sHex: '. implode("", $this->aHex));
		var_dump('aHex: '. implode(" ", $this->aHex));
    
    #var_dump(['$this->aHex', $this->aHex]);
		//var_dump($this->oAddress);
/*
Call Data
[
	"0x6057361d0000000000000000000000000000000000000000000000000000000000000021"
][
	"0x6057361d0000000000000000000000000000000000000000000000000000000000000042"
]
*/
	
		#var_dump($this->oSession->aData['memory']);
		//$aHex = str_split($this->oSession->aData['memory'], 2);
		//$aHex = $this->oSession->aData['memory'];
		//$this->aHex = str_split('6057361d0000000000000000000000000000000000000000000000000000000000000042', 2);
		
		#$aHex = str_split('6057361d0000000000000000000000000000000000000000000000000000000000000042', 2);
		#$aHex = str_split('2e64cec1', 2);
		#var_dump(	$aHex);
		#array('60','57','36','1d','00','00','00','00','00','00','00','00','00','00','00','00','00','00','00','00','00','00','00','00','00','00','00','00','00','00','00','00','00','00','00','42')

		//var_dump(implode("','", $aHex));
		//var_dump($aHex);
    /*
		$aHex = array('60', '57', '36', '1d');
		$aHex = array_map(function($sHex) {
			$sHex = base_convert($sHex, 16, 10);
			if ($sHex == 0) $sHex = '00';
			return $sHex;
		}, $aHex);
		var_dump(implode(" ", $aHex));
		*/
		/*

		!!! if firs hex is identic check out if the second is also identic.
		
		$this->aHex = array(
			//96,128,96,64,82,52,128,21,97,0,16,87,96,0,128,253,91,80,96,200,128,97,0,31,96,0,57,96,0,243,254,96,128,96,64,82,52,128,21,96
			//0x60,0x57,0x36,0x1d,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x21
			//0x60,0x57,0x36,0x1d,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x00,0x42

			//0x56, //JUMP
			0x60, 0xc8, //PUSH1
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

		if (!$this->oOpcodes->hes_set($this->aHex)) die('oOpcodes->hes_set');
		if (!$this->oMemory->hes_set($this->aHex)) die('oMemory->hes_set');
		if (!$this->oState->hes_set($this->aHex)) die('oState->hes_set');
		
		for ($i = 0; $i<count($this->aHex); $i++) {
				
			#$sHex = $this->aHex[$i];
			#if (!$this->oOpcodes->initiate($i, $sHex)) die('oOpcodes->initiate'); // view
			#if (!$this->oOpcodes->describe($i, $sHex)) die('oOpcodes->describe');
			
		}
		
		print(PHP_EOL);print(PHP_EOL);
		print(PHP_EOL);print(PHP_EOL);print(PHP_EOL);

		var_dump('------------------------------------------------------------------------------');
		
		
		$i_opargs = 0;
		#foreach ($this->aHex as $i => $sHex) {
		for ($i = 0; $i < count($this->aHex); $i++) {
			
			$sHex = $this->aHex[$i];
      $sDec = hexdec($sHex);
      
			$this->i_pc = $i;
      
			if ($i_opargs !== 0) { $i_opargs--; continue; }
		
			if (!$this->oOpcodes->initiate($i, $sHex)) die('oOpcodes->initiate'); // view
			if (!$this->oOpcodes->describe($i, $sHex)) die('oOpcodes->describe');
		
			#$aArguments = Opcodes::$_aArguments; #$this->oOpcodes->aArguments;
			#$iDelta = Opcodes::$_aaOpcodes[$sDec][1]; #$this->oOpcodes->aaOpcodes[$sDec][1];
			
      $aa_p = array(
      	$sHex,
      	#$aArguments,
      	#$iDelta,
      	$this->i_pc,
      	$this->oStack->aaStack
      );
			
			if (!$this->oStack->positioning($i, $sHex)) die('oStack->positioning');
			#if (!$this->oState->positioning($aa_p)) die('oState->positioning');
			#if (!$this->oMemory->positioning($aa_p)) die('oMemory->positioning');
			#if (!$this->oStorage->positioning($aa_p)) die('oStorage->positioning');
			
			$i = $aa_p[1];
			$this->oStack->aaStack = $aa_p[2];
			if ($aa_p[1] == -1) break; //array()
			$i_opargs = count(Opcodes::$_aArguments);
			
			
		}
		
		print(PHP_EOL);print(PHP_EOL);
		print(PHP_EOL);print(PHP_EOL);print(PHP_EOL);
		
		var_dump('------------------------------------------------------------------------------');
		var_dump('$this->oMemory->aaMemory');
		var_dump("Memory::". implode("::", $this->oMemory->aaMemory[1234]));
		var_dump('$this->oStack->aaStack');
		var_dump("Stack::". implode("::", $this->oStack->aaStack));
		var_dump('$this->oStorage->aaStorage');
		//var_dump("Storage::". implode("::", $this->oStorage->aaStorage));
		var_dump($this->oStorage->aaStorage);
		//$this->oSession->aData["stack"] = $this->oStack->aaStack;
		//$this->oSession->aData["memory"] = $this->oMemory->aaMemory[1234];
		#$this->oSession->save_session($this->oSession->aData);
		//if (!$this->save_session()) die('$this->save_session');
		#var_dump($this->oSession->aData);
		return true;
	}

}

?>