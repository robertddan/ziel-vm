<?php

namespace Ziel;

use Ziel\Vm\Route;
use Ziel\Org\Event;
use Ziel\End\Transport;

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
		#$this->oTransport = new Transport();
		return true;
	}

	public function run () {
		#if (!$this->oTransport->implement()) die('oTransport->implement');
		print(PHP_EOL);print(PHP_EOL);print(PHP_EOL);
		if (!$this->oRoute->init($this->oEvent)) die('oRoute->init');
		print(PHP_EOL);print(PHP_EOL);print(PHP_EOL);
		if (!$this->oRoute->implement()) die('oRoute->implement');
		
	}
}

?>