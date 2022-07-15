<?php
namespace App\Suiteziel;

use App\Suiteziel\Vm\Box;

class Vm
{

	public $oBox;
	public $aHex;
	
	public function __construct() {
		$this->oBox = new Box();
	}
	
	public function set_hex($aHex = null) :bool {
		if (empty($aHex)) return false;
		$this->aHex = $aHex;
		return true;
	}
	
	// loop
	public function run () {
		
		if (!$this->oBox->hex_set($this->aHex)) die('oBox->hex_set');
		if (!$this->oBox->implement()) die('oBox->implement');

		
	}

}

?>