<?php
namespace App\Suiteziel\Vm;


use App\Suiteziel\Vm\Box;

class State extends Box
{
	public $aaState;

	public function __construct () {
		$this->aaState = array();
	}
	
	public function positioning($i_k = null, $sHex = null) {
		switch ($sHex) {
			default: return true; break;
		}
		return true;
	}
}
?>