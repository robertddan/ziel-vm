<?php
namespace App\Suiteziel;


use App\Suiteziel\Vm\Box;

class Vm
{

	public $oBox;
	
	public function __construct() {
		
		
		$this->oBox = new Box();
	}
	

	public function run () {
		if (!$this->oBox->implement()) die('oBox->implement');
		
		
	}

}

?>