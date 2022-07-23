<?php
namespace App\Suiteziel\Org;

use App\Suiteziel\Org\Address;
use App\Suiteziel\Org\Database;
use App\Suiteziel\Org\Diamonds;
use App\Suiteziel\Org\Session;
use App\Suiteziel\Org\Utils;

class Event
{
	public $aaEvents;
	
	public $oAddress;
	public $oDatabase;
	public $oDiamonds;
	public $oSession;
	public $oUtils;
	
	public function __construct () {
		$this->oAddress = new Address();
		$this->oDatabase = new Database();
		$this->oDiamonds = new Diamonds();
		$this->oSession = new Session();
		$this->oUtils = new Utils();
	}

}

?>