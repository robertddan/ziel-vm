<?php
namespace App\Suiteziel\Vm;


use App\Suiteziel\Vm\Box;

class Storage extends Box
{
	public $aaStorage;
	
	public function __construct () {
		$this->aaStorage = array();
	}
	
	public function test() {
		return  "Hello woorld Storage";
	}
}

?>