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
		return true;
	}

	public function get_hex ($bSession = 2, $sContract = null) :bool {
    if ($bSession == 1) self::$aHex = $this->oSession->aData[$sContract]['aHex'];
    elseif($bSession == 2) self::$aHex = $this->oSession->aData[$sContract]["memory"];
    else self::$aHex = $this->oDiamonds->aHex;
    
		if ($bSession == 1) print "<h2>aHex</h2>";
    elseif($bSession == 2) print "<h2>memory</h2>";
    else print "<h2>oDiamonds</h2>";
    #var_dump("self".implode("", self::$aHex));
    #var_dump("memory".implode("", $this->oSession->aData["memory"]));
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
		$this->oSession->aData["memory"] = Memory::$aaMemory;
		$this->oSession->aData["stack"] = Stack::$aaStack;
		$this->oSession->aData['aHex'] = self::$aHex;
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
/*
		$sHex = "6080604081815260018054600160a060020a0319163390811790915560008181526020818152929".
		"02034908190558352917f88a5966d370b9919b20f3e2c13ff65706f196a4e32cc2c12bf57088f88525874".
			"9190a26103cc806100636000396000f3fe608060405260043610610051577c010000000000000000000".
			"000000000000000000000000000000000000060003504631a69523081146100c957806338af3eed1461".
			"00f157806370a082311461012957005b366100c75733600090815260208190526040812080543492906".
			"10075908490610338565b909155505060015461008f90600160a060020a031661016d565b5060405134".
			"815233907f88a5966d370b9919b20f3e2c13ff65706f196a4e32cc2c12bf57088f88525874906020016".
			"0405180910390a2005b005b6100dc6100d7366004610308565b61016d565b6040519015158152602001".
			"5b60405180910390f35b3480156100fd57600080fd5b5060015461011190600160a060020a031681565".
			"b604051600160a060020a0390911681526020016100e8565b34801561013557600080fd5b5061015f61".
			"0144366004610308565b600160a060020a031660009081526020819052604090205490565b604051908".
			"1526020016100e8565b6000600160a060020a0382166101cd5760405160e560020a62461bcd02815260".
			"206004820152601060248201527f526571756972653a204164647265737300000000000000000000000".
			"00000000060448201526064015b60405180910390fd5b33600090815260208190526040902054341115".
			"61022f5760405160e560020a62461bcd02815260206004820152601960248201527f526571756972653".
			"a2042616c616e6365207472616e736665720000000000000060448201526064016101c4565b33600090".
			"8152602081905260408120805434929061024e908490610350565b9091555050600160a060020a03821".
			"66000908152602081905260408120805434929061027b908490610338565b9091555050604051348152".
			"600160a060020a0383169033907fddf252ad1be2c89b69c2b068fc378daa952ba7f163c4a11628f55a4".
			"df523b3ef9060200160405180910390a3604051348152600160a060020a0383169033907fddf252ad1b".
			"e2c89b69c2b068fc378daa952ba7f163c4a11628f55a4df523b3ef9060200160405180910390a350600".
			"1919050565b60006020828403121561031a57600080fd5b8135600160a060020a038116811461033157".
			"600080fd5b9392505050565b6000821982111561034b5761034b610367565b500190565b60008282101".
			"561036257610362610367565b500390565b7f4e487b7100000000000000000000000000000000000000".
			"000000000000000000600052601160045260246000fdfea2646970667358221220bddf897c698f43b5d".
			"611924b5b5224d6621ced150b80b82b89cf3ea11065926964736f6c63430008060033";
*/
		
			# contract Callvalue 
			#$sHex = "60806040908152336000908152602081905220349055610226806100246000396000f3fe608060405260043610610046577c010000000000000000000000000000000000000000000000000000000060003504631a695230811461007457806370a082311461009c57005b3661007257336000908152602081905260408120805434929061006a908490610184565b925050819055005b005b61008761008236600461019c565b6100ed565b60405190151581526020015b60405180910390f35b3480156100a857600080fd5b506100df6100b736600461019c565b73ffffffffffffffffffffffffffffffffffffffff1660009081526020819052604090205490565b604051908152602001610093565b3360009081526020819052604081208054349190839061010e9084906101d9565b909155505073ffffffffffffffffffffffffffffffffffffffff821660009081526020819052604081208054349290610148908490610184565b9091555060019392505050565b7f4e487b7100000000000000000000000000000000000000000000000000000000600052601160045260246000fd5b6000821982111561019757610197610155565b500190565b6000602082840312156101ae57600080fd5b813573ffffffffffffffffffffffffffffffffffffffff811681146101d257600080fd5b9392505050565b6000828210156101eb576101eb610155565b50039056fea264697066735822122067cc3e11fdd07670043726904925811ab764856d7cdb06ae280167fa53723da264736f6c634300080f0033";
/*
PUSH1 00
PUSH1 00
PUSH8 4978815011915260
CREATE

PUSH1 00
MSTORE
PUSH1 32
PUSH1 00
RETURN
*/
		#$sHex = "60006000612328f060005260206000f3";
		
		
    if (!$this->get_hex(2, $this->rContract)) die('get_hex');
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

		// save session
		if (0) if (!$this->save_session($this->rContract)) die('$this->save_session');

		return true;
	}

}

?>