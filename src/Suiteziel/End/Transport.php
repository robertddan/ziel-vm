<?php
namespace App\Suiteziel\End;


class Transport
{

	public function __construct () {
	}

	public function implement($o = null) {

		#$sPayload = '{"jsonrpc":"2.0","method":"eth_blockNumber","params":[],"id":1}';
		#$sPayload = '{"method":"parity_enode","params":[],"id":1,"jsonrpc":"2.0"}';
		
		// Contract address after transaction
		$sTransactionHash = "";
		$sContractAddress = '{"method":"eth_getTransactionReceipt","params":["'.$sTransactionHash.'"],"id":1,"jsonrpc":"2.0"}';
		#'{"method":"eth_sendTransaction","params":[{"from":"0xb60e8dd61c5d32be8058bb8eb970870f07233155","to":"0xd46e8dd67c5d32be8058bb8eb970870f07244567",
		#"gas":"0x76c0","gasPrice":"0x9184e72a000","value":"0x9184e72a","data":"0xd46e8dd67c5d32be8d46e8dd67c5d32be8058bb8eb970870f072445675058bb8eb970870f072445675"}]
		#,"id":1,"jsonrpc":"2.0"}'
		$sSendFrom = "0xe9884777D9F377530788CeE12A40269f812cF30a";
		$sSendTo = ""; #"0xd46e8dd67c5d32be8058bb8eb970870f07244567";
		$sSendData = "0x600060006009f0"; #0xd46e8dd67c5d32be8d46e8dd67c5d32be8058bb8eb970870f072445675058bb8eb970870f072445675
		$sSendTransaction = '{"method":"eth_sendTransaction",
		"params":[{
		"from":"'. $sSendFrom .'",
		"to":"'. $sSendTo .'",
		"gas":"0x76c0",
		"gasPrice":"0x9184e72a000",
		"value":"0x9184e72a",
		"data":"'. $sSendData .'"}],
		"id":1,
		"jsonrpc":"2.0"}';
		
		#'{"method":"eth_sendRawTransaction","params":["0xd46e8dd67c5d32be8d46e8dd67c5d32be8058bb8eb970870f072445675058bb8eb970870f072445675"],"id":1,"jsonrpc":"2.0"}'
		$sSendFrom = "0xe9884777D9F377530788CeE12A40269f812cF30a";
		$sSendTo = ""; #"0xd46e8dd67c5d32be8058bb8eb970870f07244567";
		$sSendData = "0x600060006009f0"; #0xd46e8dd67c5d32be8d46e8dd67c5d32be8058bb8eb970870f072445675058bb8eb970870f072445675
		$sRawTransaction = '{"method":"eth_signTransaction",
		"params":[{
		"from":"'. $sSendFrom .'",
		"to":"",
		"data":"'. $sSendData .'"}],
		"id":1,
		"jsonrpc":"2.0"}';

		
		
		#'{"method":"eth_sign","params":["0xcd2a3d9f938e13cd947ec05abc7fe734df8dd826","0x5363686f6f6c627573"],"id":1,"jsonrpc":"2.0"}'
		$sSendFrom = "0xe9884777D9F377530788CeE12A40269f812cF30a";
		$sSendTo = ""; #"0xd46e8dd67c5d32be8058bb8eb970870f07244567";
		$sSendData = "0x600060006009f0"; #0xd46e8dd67c5d32be8d46e8dd67c5d32be8058bb8eb970870f072445675058bb8eb970870f072445675
		$sRawTransaction = '{"method":"eth_sign",
		"params":[
			"0xe9884777D9F377530788CeE12A40269f812cF30a",
			"0x600060006009f0"
		],
		"id":1,
		"jsonrpc":"2.0"}';
		
		$sResult = $this->rpc_request($sRawTransaction);
		var_dump($sResult);
		
		
		return true;
	}
	
	public function rpc_request($aPayload, $aHeaders = array()) {
		$sUrl = 'https://ropsten.infura.io/v3/3e7f88ed3dc242c38332ecf58900a68e';
		#$sUrl = '64.25.109.146';
		
		if (is_array($aPayload)) $sPayload = json_encode($aPayload);
		else $sPayload = $aPayload;
		
		if (empty($aHeaders)) $aHeaders = array(
				'Content-Type: application/json',
				'Content-Length: '. strlen($sPayload)
		);
			
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $sUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_POST, true);
		#curl_setopt($ch, CURLOPT_PORT, 30303);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $sPayload);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeaders);

		$output = curl_exec($ch);
		curl_close($ch);
		return $output;
	}
	
	public function shift_left ($sHex) {
		return "0x". str_pad($sHex, 64, 0, STR_PAD_LEFT);
	}
    		
	public function shift_right ($sHex) {
		return "0x". str_pad($sHex, 64, 0, STR_PAD_RIGHT);
	}
	
	private function rpc_client($o){}
	private function rpc_server($o){}
}

?>