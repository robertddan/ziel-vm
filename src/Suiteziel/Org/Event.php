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
		if (!$this->init_classes()) die('$this->init_classes');
		if (!$this->init_variables()) die('$this->init_variables');
	}
	
	public function init_classes () :bool {
		$this->oAddress = new Address();
		$this->oDatabase = new Database();
		$this->oDiamonds = new Diamonds();
		$this->oSession = new Session();
		$this->oUtils = new Utils();
		return true;
	}
	
	public function init_variables () :bool {
		if (!$this->init__address()) die('$this->init__address');
		if (!$this->init__diamonds()) die('$this->init__diamonds');
		if (!$this->init__session()) die('$this->init__session');
		return true;
	}
	
	/*
Call Stack

    0:
    0xd9145CCE52D386f254917e481eB44e9943F39138

Call Data

    0:
    0x6057361d0000000000000000000000000000000000000000000000000000000000000037
	*/
	
	public function init__address () :bool {
		if (!$this->oAddress->generate_keys()) die('$this->oAddress->generate_keys()');
		return true;
	}
	
	public function init__diamonds ($bInit = -1) :bool {
  	$this->oDiamonds->iCursor = $bInit; // skip compilation
    
    if ($bInit == -1) return true;
    if ($bInit == 1) {
  		$this->oDiamonds->sContract = 'Storage.sol'; // contract file name in contracts folder
  		if (!$this->oDiamonds->set_input_contract()) die('oDiamonds->set_input_contract'); //set it
		  if (!$this->oDiamonds->compile_contract()) die('oDiamonds->compile_contract');
		  if (!$this->oDiamonds->iCursor) die('oDiamonds->iCursor');
    }
    
    $this->oDiamonds->sFolder = '20220820075259000000'; // specify folder with set_out_folder or at read...
    if (!$this->oDiamonds->set_output_folder()) die('oDiamonds->set_output_folder'); //set it
		if (!$this->oDiamonds->read_from_file()) die('oDiamonds->read_from_file');
		if (!$this->oDiamonds->sHex) die(PHP_EOL .'oDiamonds->sHex');

		#if (!$this->oDiamonds->decode_hex()) die('oDiamonds->decode_hex');
		if (!$this->oDiamonds->split_hex()) die('oDiamonds->split_hex');

		var_dump('sHex: '. $this->oDiamonds->sHex);
		var_dump('aHex: '. implode(" ", $this->oDiamonds->aHex));
		return true;
	}
	
	public function init__session () :bool {
		//if (!$this->oSession->new_session()) die('$this->oSession->new_session()');
		//if (!$this->oSession->save_session($aSession)) die('$this->oSession->save_session()');
		if (!$this->oSession->load_session()) die('$this->oSession->load_session()');
		return true;
	}
}

?>