<?php
namespace App\Suiteziel\Org;


class Database
{
	public $sPath;
	
	public function __construct () {
		$this->sPath = __DIR__ .'/../.database/';
	}
	
	public function set_path ($sPath = '') {
		$this->sPath = $this->sPath . $sPath;
	}
	
	public function new () {
		return array(
			'data' => null,
			'file' => null
		);
	}
	
	public function write ($aData) :bool {
		if (empty($aData['data'])) return false;
		$sJson = json_encode($aData);
		$aData['file'] = $this->sPath .'/'. date('YmdHisu') .'.json';
		if (file_put_contents($aData['file'], $sJson)) return true;
		else return false;
	}

	public function read ($d) {
		return false;
	}

/*
new o_db
o_db-new() = a
o_db-write() = b

*/

}

?>