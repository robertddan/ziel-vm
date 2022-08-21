<?php
namespace App\Suiteziel\End;


use Web3\Web3;

class Transport
{

	public function __construct () {
	}

	public function implement($o = null) {
		
		$web3 = new Web3('https://ropsten.infura.io/v3/3e7f88ed3dc242c38332ecf58900a68e');
		
		
    $accounts = $web3->eth()->getBalance('0xe9884777D9F377530788CeE12A40269f812cF30a')->toEth(); // 100
    var_dump($accounts);
/*		
curl https://mainnet.infura.io/v3/3e7f88ed3dc242c38332ecf58900a68e \
-X POST \
-H "Content-Type: application/json" \
-d '{"jsonrpc":"2.0","method":"eth_blockNumber","params":[],"id":1}'
*/
		#$sPayload = '{"jsonrpc":"2.0","method":"eth_blockNumber","params":[],"id":1}';
		#$sPayload = '{"method":"parity_enode","params":[],"id":1,"jsonrpc":"2.0"}';
		
		
		$sPayload = '{"method":"eth_protocolVersion","params":[],"id":1,"jsonrpc":"2.0"}';
		#string(40) "{"jsonrpc":"2.0","id":1,"result":"0x41"}"
		
		
		
		
		$sResult = $this->rpc_request($sPayload);
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
	
	private function rpc_client($o){}
	private function rpc_server($o){}
}

?>