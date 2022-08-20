<?php
namespace App\Suiteziel\Vm;


use App\Suiteziel\Vm\Opcodes;
use App\Suiteziel\Vm\Memory;
use App\Suiteziel\Vm\Stack;
use App\Suiteziel\Vm\State;
use App\Suiteziel\Vm\Storage;

class Route
{

	public $i_pc;
	public $aHex;
	public static $_aHex;
		
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
	
	public function init_variables_ ($bSession = 0) :bool {
		$this->i_pc = 0;
    if ($bSession) $this->aHex = self::$_aHex = $this->oSession->aData['aHex'];
    else $this->aHex = self::$_aHex = $this->oDiamonds->aHex;
		
		return true;
	}
	
	public function save_session () :bool {
		/*$aaSession = array(
			'oAddress' => $this->oAddress->aAddress,
			'oDatabase' => $this->oDatabase->sPath,
			'oDiamonds' => $this->oDiamonds->aHex,
			'oSession' => $this->oSession->aData,
		);*/

    $this->oSession->aData["stack"] = $this->oStack->aaStack;
    $this->oSession->aData["memory"] = $this->oMemory->aaMemory[1234];
		$this->oSession->aData['aHex'] = $this->aHex;
    $this->oSession->save_session($this->oSession->aData);
    var_dump($this->oSession->aData);
    
		return true;
	}
	
	public function implement () :bool {

    if (!$this->init_variables_(1)) die('init_variables_');
    #if (1) if (!$this->save_session()) die('$this->save_session');
    

		if (empty($this->aHex)) die('Route->implement');
		var_dump('sHex: '. implode("", $this->aHex));
		var_dump('aHex: '. implode(" ", $this->aHex));
    
    #$this->aHex = array(0x00); //STOP
    
		#if (!$this->oOpcodes->hes_set($this->aHex)) die('oOpcodes->hes_set');
		#if (!$this->oMemory->hes_set($this->aHex)) die('oMemory->hes_set');
		#if (!$this->oState->hes_set($this->aHex)) die('oState->hes_set');
		
		for ($i = 0; $i<count($this->aHex); $i++) {
				
			#$sHex = $this->aHex[$i];
			#if (!$this->oOpcodes->initiate($i, $sHex)) die('oOpcodes->initiate'); // view
			#if (!$this->oOpcodes->describe($i, $sHex)) die('oOpcodes->describe');
			
		}
		
		print(PHP_EOL);print(PHP_EOL);
		print(PHP_EOL);print(PHP_EOL);print(PHP_EOL);

		print('------------------------------------------------------------------------------');
		
		
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
			/*
      $aa_p = array(
      	$sHex,
      	$this->i_pc,
      	$this->oStack->aaStack
      );
			*/
			if (!$this->oStack->positioning($i, $sHex)) die('oStack->positioning');
			if (!$this->oState->positioning($i, $sHex)) die('oState->positioning');
			#if (!$this->oMemory->positioning($i, $sHex)) die('oMemory->positioning');
			#if (!$this->oStorage->positioning($i, $sHex)) die('oStorage->positioning');
			
			#$i = $aa_p[1];
			#$this->oStack->aaStack = $aa_p[2];
			$i_opargs = count(Opcodes::$_aArguments);
			if ($i == -1) break; //array()
			
		}
		
		print(PHP_EOL);print(PHP_EOL);
		print(PHP_EOL);print(PHP_EOL);print(PHP_EOL);
		print('------------------------------------------------------------------------------');
    print(PHP_EOL);
		print('$this->oMemory->aaMemory');
    print(PHP_EOL);
		print("Memory::". implode("::", $this->oMemory->aaMemory[1234]));
    print(PHP_EOL);
		print('Stack::$aaStack');
    print(PHP_EOL);
		print("Stack::". implode("::", Stack::$aaStack));
    print(PHP_EOL);
		print('$this->oStorage->aaStorage');
    print(PHP_EOL);
		var_dump("Storage::". implode("::", $this->oStorage->aaStorage));
		print_r($this->oStorage->aaStorage);


    return true;
	}

}

?>