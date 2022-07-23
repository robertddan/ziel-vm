<?php
namespace App\Suiteziel;


use App\Suiteziel\Vm\Route;
use App\Suiteziel\Org\Event;

class Vm
{

	public $oEvent;
	public $oRoute;
	
	public function __construct() {
		if (!$this->init_()) die('Vm->init');
	}
	
	protected function init_ () :bool {
		$this->oEvent = new Event();
		$this->oRoute = new Route();
		return true;
	}

	public function run () {
		if (!$this->oRoute->init($this->oEvent)) die('oRoute->init');
		if (!$this->oRoute->implement()) die('oRoute->implement');
		
	}

}

?>