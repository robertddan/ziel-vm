<?php
namespace App\Suiteziel\Org;


use App\Suiteziel\Org\Event;

class Database extends Event
{
	public $sPath;
	
	public function __construct () {
		$this->sPath = __DIR__ .'/../.database/';
	}

	public function new () {
		return array(
			'data' => null,
			'file' => date('YmdHisu') .'.json'
		);
	}
	
	public function write ($aData) :bool {
		if (empty($aData['file'])) return false;
		if (empty($aData['data'])) return false;
		if (file_put_contents($this->sPath . $aData['file'], json_encode($aData))) return true;
		else return false;
	}

	public function set_filepath ($sFilepath) {
		$this->sPath = $this->sPath . $sFilepath;
	}
	
	public function read () {
		return file_get_contents($this->sPath);
	}


/*
new o_db
o_db-new() = a
o_db-write() = b


use App\Suiteziel\Org\Database;
$oDatabase = new Database();
$aData = $oDatabase->new();
var_dump($aData);
$aData['file'] = '20220718171223000000.json';
$aData['data'] = array('Hello Database!');
var_dump($oDatabase->write($aData));

var_dump($oDatabase->set_filepath('20220718171223000000.json'));
var_dump($oDatabase->read());


*/


}

?>