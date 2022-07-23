<?php
namespace App\Suiteziel;


use App\Suiteziel\Vm\Route;
use App\Suiteziel\Org\Event;

class Vm
{

	public $oRoute;
	public $oEvent;
	
	public function __construct() {
		$this->oRoute = new Route();
		$this->oEvent = new Event();
	}
	

	public function run () {
		if (!$this->oRoute->implement()) die('oRoute->implement');
		
		
	}

}

?>