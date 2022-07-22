<?php
namespace App\Suiteziel\Org;


class Session
{
	public $sPath;
	public $aData;
	public static $_aData;
	
	public function __construct () {
		$this->sPath = __DIR__ .'/../.database/.session';
	}
	
	public function new_session ($aData = array()) :bool {
		if (file_put_contents($this->sPath, serialize($aData))) return true;
		else return false;
	}

	public function load_session () :bool {
		$this->aData = self::$_aData = unserialize(file_get_contents($this->sPath));
		return true;
	}

	public function save_session ($aData) :bool {
		if (file_put_contents($this->sPath, serialize($aData))) return true;
		else return false;
	}
	
}

?>