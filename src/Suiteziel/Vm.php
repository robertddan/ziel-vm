<?php
namespace App\Suiteziel;


use App\Suiteziel\Vm\Route;
use App\Suiteziel\Org\Event;

class Vm
{

	protected $oEvent;
	public $oRoute;
	public $bLocks;
	
	public function __construct() {
		
		if (!$this->init_classes()) die('Vm->init_classes');

	}
	
	public function init_classes () :bool {
		
		//if ($this->bLocks) return true;
		$this->oEvent = array(1,2,3,4); //new Event();
		$this->oRoute = new Route();
		$this->bLocks = true;
		return true;
		
	}

	public function run () {
		if (!$this->oRoute->init()) die('oRoute->init');
		//if (!$this->oRoute->implement()) die('oRoute->implement');
		
	}

}

?>