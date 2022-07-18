<?php
namespace App\Suiteziel\Vm;


use App\Suiteziel\Vm\Box;

class Memory extends Box
{
	public $aaMemory;
	
	public function __construct () {
		$this->aaMemory = array();
	}
	
	public function test() {
		return  "Hello woorld Memory";
	}
}

?>