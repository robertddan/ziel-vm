<?php
namespace App\Suiteziel\Vm;

use App\Suiteziel\Vm\Opcodes;
use App\Suiteziel\Vm\Stack;


class Box
{
	public $i_pc; //program counter
	public $aArguments;
	public $aHex;

	function __construct() {
		$this->oOpcodes = new Opcodes();
		$this->oMemory = new Memory();
		$this->oStack = new Stack();
	}
	
	public function new_from_call($sJson = null, $aParameters = null) {
		return  "Hello woorld Memory";
	}
	
	public function new_from_cli($sJsonHex = null, $aParameters = null) {
		return  "Hello woorld Memory";
	}
	
	public function new_from_file($sFilePath = null, $aParameters = null) {
		return  "Hello woorld Memory";
	}
	public function decode($sHex = null) {
		$aHex = str_split($sHex, 2);
		
		//var_dump($aHex);
	}
	
	public function push () {
		array_unshift($oStack->aaStack, array_reverse($oStack->aArguments));
	}
		
	public function hex_set ($aHex = null) :bool {
		$this->aHex = $aHex;
		return true;
	}
	
	public function implement ($iKey = null, $sHex = null): bool { // $aArguments = null, 
		
		
		if (!$this->oOpcodes->hex_set($this->aHex)) die('oOpcodes->hex_set');
		
		$iCountArguments = 0; //box pc var
		foreach ($this->aHex as $k => $sHex) {
			if ($iCountArguments !== 0) {
				$iCountArguments = $iCountArguments - 1;
				continue;
			}

			if (!$this->oOpcodes->initiate($k, $sHex)) die('oOpcodes->initiate');
			if (!$this->oOpcodes->describe($k, $sHex)) die('oOpcodes->describe');
			
			//if (!$this->oBox->implement($k, $sHex)) die('oBox->implement');
			
			$iCountArguments = count($this->oOpcodes->aArguments);


		}
		
		
		
		//if (!$this->oOpcodes->initiate($k, $sHex)) die('oOpcodes->initiate');
		//if (!$this->oOpcodes->describe($k, $sHex)) die('oOpcodes->describe');
/*

if (!$this->oOpcodes->initiate($iKey, $sHex)) die('oOpcodes->initiate');
if (!$this->oOpcodes->describe($iKey, $sHex)) die('oOpcodes->describe');

//if (!$this->oBox->implement($k, $sHex)) die('oBox->implement');

$this->aArguments = count($this->oOpcodes->aArguments);
*/

		//$this->aArguments = $aArguments;
		//$oStack->aArguments = '#######';
		//case 4: return $this->aaOpcodes[$sHex][3]; //name
		//case 5: return $this->aaOpcodes[$sHex][4]; //description
		/*
		switch ($iKey) {
			case 0x60: 
				return array_unshift($this->oStack->aaStack, array_reverse($this->oStack->aArguments));
				break; //ADD
		}
		*/
		
		return true;
	}
	
}

?>