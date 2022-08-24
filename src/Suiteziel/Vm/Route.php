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
	
	public $rContract;
	
	private $bSaveSession;
	private $rFrom;
		
	function __construct() {
		$this->rContract = 'Callvalue';
	}
		
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
		
		# private
		$this->bSaveSession = 0;
		$this->rFrom = 2;
		return true;
	}

	public function get_hex ($bSession = 2, $sContract = null) :bool {
    if ($bSession == 1) self::$aHex = $this->oSession->aData[$sContract]['hex'];
    elseif($bSession == 2) self::$aHex = $this->oSession->aData[$sContract]["memory"];
    else self::$aHex = $this->oDiamonds->aHex;
    
		if ($bSession == 1) print "<h2>aHex</h2>";
    elseif($bSession == 2) print "<h2>memory</h2>";
    else print "<h2>oDiamonds '{$this->rContract}'</h2>";
    #var_dump("self".implode("", self::$aHex));
    #var_dump("memory".implode("", $this->oSession->aData["memory"]));
		if($bSession == 2) {
			$this->oAddress->aAddress = $this->oSession->aData[$sContract]["wallet"];
			Memory::$aaMemory = $this->oSession->aData[$sContract]["memory"];
			Storage::$aaStorage = $this->oSession->aData[$sContract]["storage"];
		}
		
		return true;
	}
  
	public function save_session ($sContract = null) :bool {
		/*$aaSession = array(
			'oAddress' => $this->oAddress->aAddress,
			'oDatabase' => $this->oDatabase->sPath,
			'oDiamonds' => $this->oDiamonds->aHex,
			'oSession' => $this->oSession->aData,
		);*/
		print "<h2>save_session()</h2>";
		$this->oSession->aData["wallet"] = $this->oAddress->aAddress;
		$this->oSession->aData['hex'] = self::$aHex;
		$this->oSession->aData["stack"] = Stack::$aaStack;
		$this->oSession->aData["memory"] = Memory::$aaMemory;
		$this->oSession->aData["storage"] = Storage::$aaStorage;
			
		$this->oSession->aData[$sContract] = array();
		$this->oSession->aData[$sContract] = $this->oSession->aData;
		#$this->oSession->aData = array();
		$this->oSession->save_session($this->oSession->aData);
		var_dump($this->oSession->aData);
		return true;
	}
	
		
	public function debug_counter () :bool {
		for ($i = 0; $i < count(self::$aHex); $i++) {
				
			$sHex = self::$aHex[$i];
			if (!$this->oOpcodes->initiate($i, $sHex)) die('oOpcodes->initiate'); // view
			if (!$this->oOpcodes->describe($i, $sHex)) die('oOpcodes->describe');
		}
		print(PHP_EOL);print(PHP_EOL);
		print(PHP_EOL);print(PHP_EOL);print(PHP_EOL);
		print('------------------------------------------------------------------------------');
		return true;
	}

	public function setup() {
		if (!$this->get_hex($this->rFrom, $this->rContract)) die('get_hex');
		#self::$aHex = str_split($sHex, 2);
		if (empty(self::$aHex)) die('Route->implement');
		$sHex = self::$aHex;
		var_dump('sHex: '. implode("", self::$aHex));
		var_dump('aHex: '. implode(" ", self::$aHex));
		#if (!$this->debug_counter()) die('$this->debug_counter()');
		#var_dump($this->oSession->aData);
		return true;
	}
	
	public function implement () :bool {
		if (!$this->setup()) die('$this->setup()');
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
		}
		// end_vars
		if (!$this->end_vars()) die('$this->end_vars()');
		// save session
		if ($this->bSaveSession) if (!$this->save_session($this->rContract)) die('$this->save_session');
		return true;
	}

	public function end_vars() :bool {
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
		foreach(Storage::$aaStorage as $k => $aaStorage) print("Storage::". implode("::", (array) $aaStorage));
		return true;
	}
}

?>