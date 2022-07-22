<?php
namespace App\Suiteziel\Org;


class Session
{
	public $sPath;
	public $sData;
	
	public function __construct () {
		$this->sPath = __DIR__ .'/../.database/.session';
	}
	
	public function new_session () :bool {
		if (file_put_contents($this->sPath, serialize(array()))) return true;
		else return false;
	}

	public function load_session () :bool {
		$this->sData = unserialize(file_get_contents($this->sPath));
		return true;
	}

	public function save_session ($sData) :bool {
		if (file_put_contents($this->sPath, serialize($sData))) return true;
		else return false;
	}
	
}

?>