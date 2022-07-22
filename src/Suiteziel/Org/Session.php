<?php
namespace App\Suiteziel\Org;


class Session
{

	public function __construct () {
		$this->aConfig = array(
			'file' => OPENSSL_KEYTYPE_EC,
			'curve_name' => 'secp256k1'
		);
	}
	
	public function generate_keys () :bool {
		
	}
	
	
}

?>