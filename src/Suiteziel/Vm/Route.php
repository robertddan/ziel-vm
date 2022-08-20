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
	public static $aHex;
		
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
    if ($bSession == 1) self::$aHex = $this->oSession->aData['aHex'];
    elseif($bSession == 2) self::$aHex = $this->oSession->aData["memory"];
    else self::$aHex = $this->oDiamonds->aHex;
		
		return true;
	}
	
	public function save_session () :bool {
		/*$aaSession = array(
			'oAddress' => $this->oAddress->aAddress,
			'oDatabase' => $this->oDatabase->sPath,
			'oDiamonds' => $this->oDiamonds->aHex,
			'oSession' => $this->oSession->aData,
		);*/
    
    $this->oSession->aData["stack"] = Stack::$aaStack;
    $this->oSession->aData["memory"] = Memory::$aaMemory;
		$this->oSession->aData['aHex'] = self::$aHex;
    $this->oSession->save_session($this->oSession->aData);
    var_dump($this->oSession->aData);
    
		return true;
	}
	
	public function implement () :bool {

    if (!$this->init_variables_(2)) die('init_variables_');
    

		if (empty(self::$aHex)) die('Route->implement');
		var_dump('sHex: '. implode("", self::$aHex));
		var_dump('aHex: '. implode(" ", self::$aHex));
    
    #self::$aHex = array(0x00); //STOP
		for ($i = 0; $i < count(self::$aHex); $i++) {
				
			#$sHex = self::$aHex[$i];
			#if (!$this->oOpcodes->initiate($i, $sHex)) die('oOpcodes->initiate'); // view
			#if (!$this->oOpcodes->describe($i, $sHex)) die('oOpcodes->describe');
			
		}
		
		print(PHP_EOL);print(PHP_EOL);
		print(PHP_EOL);print(PHP_EOL);print(PHP_EOL);

		print('------------------------------------------------------------------------------');
		
		$i_opargs = 0;
		for ($i = 0; $i < count(self::$aHex); $i++) {
			
			$sHex = self::$aHex[$i];
      $sDec = hexdec($sHex);
			$this->i_pc = $i;
      
			if ($i_opargs !== 0) { $i_opargs--; continue; }
		
			if (!$this->oOpcodes->initiate($i, $sHex)) die('oOpcodes->initiate'); // view
			if (!$this->oOpcodes->describe($i, $sHex)) die('oOpcodes->describe');
			if (!$this->oStack->positioning($i, $sHex)) die('oStack->positioning');
			if (!$this->oState->positioning($i, $sHex)) die('oState->positioning');
			if (!$this->oMemory->positioning($i, $sHex)) die('oMemory->positioning');
			if (!$this->oStorage->positioning($i, $sHex)) die('oStorage->positioning');
			
			$i_opargs = count(Opcodes::$aArguments);
			if ($i == -1) break; 
			if ($i_pc >= 14) die();
		}
		
		print(PHP_EOL);print(PHP_EOL);
		print(PHP_EOL);print(PHP_EOL);print(PHP_EOL);
		print('------------------------------------------------------------------------------');
    print(PHP_EOL);
		print('Memory::$aaMemory');
    print(PHP_EOL);
		print("Memory::". implode("::", Memory::$aaMemory));
    print(PHP_EOL);
		print('Stack::$aaStack');
    print(PHP_EOL);
		print("Stack::". implode("::", Stack::$aaStack));
    print(PHP_EOL);
		print('Storage::$aaStorage');
    print(PHP_EOL);
		print("Storage::". implode("::", Storage::$aaStorage));

    // save session
    if (0) if (!$this->save_session()) die('$this->save_session');
    
    return true;
	}

}

?>