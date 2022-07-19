<?php
namespace App\Suiteziel;


use App\Suiteziel\Vm\Route;

class Vm
{

	public $oRoute;
	
	public function __construct() {
		
		
		$this->oRoute = new Route();
	}
	

	public function run () {
		if (!$this->oRoute->implement()) die('oRoute->implement');
		
		
	}

}

?>