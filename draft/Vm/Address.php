<?php

namespace Ziel\Org;


#use Sop\CryptoTypes\Asymmetric\EC\ECPublicKey;
#use Sop\CryptoTypes\Asymmetric\EC\ECPrivateKey;
#use Sop\CryptoEncoding\PEM;
#use kornrunner\Keccak;

class Address
{

	private $aConfig;
	private $oOpaque;
	
	public $aAddress;
	
	public $sAddress;
	public $sKeyPrivate;
	public $sKeyPublic;
/*
	public function __construct () {
		$this->aConfig = array(
			'private_key_type' => OPENSSL_KEYTYPE_EC,
			'curve_name' => 'secp256k1'
		);
		$this->oOpaque = openssl_pkey_new($this->aConfig);
		if (!$this->oOpaque) die('ERROR: Fail to generate private key. -> ' . openssl_error_string());
		$this->generate_keys();
		
		$this->aAddress = array(
			$this->sAddress,
			$this->sKeyPrivate,
			$this->sKeyPublic
		);
	}
*/
	public function generate_keys () :bool {
/*
		// Generate Private Key
		openssl_pkey_export($this->oOpaque, $prev_key);

		// Get The Public Key
		//        $key_detail = openssl_pkey_get_details($this->oOpaque);
		//        $pub_key = $key_detail["key"];
		$priv_pem = PEM::fromString($prev_key);

		// Convert to Elliptic Curve Private Key Format
		$ec_priv_key = ECPrivateKey::fromPEM($priv_pem);

		// Then convert it to ASN1 Structure
		$ec_priv_seq = $ec_priv_key->toASN1();

		// Private Key & Public Key in HEX
		$priv_key_hex = bin2hex($ec_priv_seq->at(1)->asOctetString()->string());
		$pub_key_hex = bin2hex($ec_priv_seq->at(3)->asTagged()->asExplicit()->asBitString()->string());


		// Derive the Ethereum Address from public key
		// Every EC public key will always start with 0x04,
		// we need to remove the leading 0x04 in order to hash it correctly
		$pub_key_hex_2 = substr($pub_key_hex, 2);


		// Hash time
		$hash = Keccak::hash(hex2bin($pub_key_hex_2), 256);


		// Ethereum address has 20 bytes length. (40 hex characters long)
		// We only need the last 20 bytes as Ethereum address
		$this->sAddress = '0x' . substr($hash, -40);
		$this->sKeyPrivate = '0x' . $priv_key_hex;
		$this->sKeyPublic = '0x' . $pub_key_hex;
		$this->aAddress = array(
			$this->sAddress,
			$this->sKeyPrivate,
			$this->sKeyPublic
		);
		*/
		
		$this->aAddress = array(
			"0xfdd4cdf352f01fc139759061c0ed1fdb9744c797",
			"0xc32053367f8ff648a57286fe0e50699932df2ffc0ec14aca1e4291a65109d4f8",
			"0x04071311a3da9416861927151bb5fc2d48995d07ff0f87d66e249518155fd714ced20ea765459bc6abe7e0d0220c87c7177ba73c75b64047e3fdd4e9f87b58651f"
		);
		return true;
		
		//return array("address" => $wallet_address, "private_key" => $wallet_private_key, "pubic_key" => $wallet_pubic_key);
	}
}

/*
$private_key = openssl_pkey_new();
$public_key_pem = openssl_pkey_get_details($private_key)['key'];
echo $public_key_pem;
$public_key = openssl_pkey_get_public($public_key_pem);
var_dump($public_key);
*/



/*




*/
?>