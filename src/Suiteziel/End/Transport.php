<?php
namespace App\Suiteziel\End;

use kornrunner\Ethereum\Transaction;

class Transport
{
	private $web3;
	
	
	public function __construct () {}

	public function implement($o = null) {
		#$this->web3 = new Web3('https://ropsten.infura.io/v3/3e7f88ed3dc242c38332ecf58900a68e');
		
		#$sPayload = '{"jsonrpc":"2.0","method":"eth_blockNumber","params":[],"id":1}';
		#$sPayload = '{"method":"parity_enode","params":[],"id":1,"jsonrpc":"2.0"}';
		
		#'{"method":"eth_sendTransaction","params":[{"from":"0xb60e8dd61c5d32be8058bb8eb970870f07233155","to":"0xd46e8dd67c5d32be8058bb8eb970870f07244567",
		#"gas":"0x76c0","gasPrice":"0x9184e72a000","value":"0x9184e72a","data":"0xd46e8dd67c5d32be8d46e8dd67c5d32be8058bb8eb970870f072445675058bb8eb970870f072445675"}]
		#,"id":1,"jsonrpc":"2.0"}'
		$sSendFrom = "0xe9884777D9F377530788CeE12A40269f812cF30a";
		$sSendTo = ""; #"0xd46e8dd67c5d32be8058bb8eb970870f07244567";
		$sSendData = "0x600060006008f0"; #0xd46e8dd67c5d32be8d46e8dd67c5d32be8058bb8eb970870f072445675058bb8eb970870f072445675
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
		$sSendData = "0x600060006008f0"; #0xd46e8dd67c5d32be8d46e8dd67c5d32be8058bb8eb970870f072445675058bb8eb970870f072445675
		$sRawTransaction = '{"method":"eth_signTransaction",
		"params":[{
		"from":"'. $sSendFrom .'",
		"to":"",
		"data":"'. $sSendData .'"}],
		"id":1,
		"jsonrpc":"2.0"}';
		
		
		$s_gasPrice = '{"method":"eth_gasPrice",
		"params":[],
		"id":1,
		"jsonrpc":"2.0"}';
		
		#$sResult_gasPrice = $this->rpc_request($s_gasPrice);
		#var_dump($sResult_gasPrice);
		
		
		/*
		"gas":"0x76c0",
		"gasPrice":"0x9184e72a000",
		let gas_limit = 5000000 //"0x100000" // Gas Limit & Usage by Txn: 5,000,000 | 21,000 (0.42%) 
		let gas_price =  25000000000 //22500000000 // fast-33 average-30 slow-22.5 // 0.0000001 Ether (100 Gwei) // gas calculator
									10000000000000
										  5000000014
											2000000014
											3500000014
												10000000
		*/
		$nonce    = '15';
		$gasPrice = '0x578B58B0E';
		$gasLimit = '0x989680';
		$to       = '0x02CC64973a38A82A446A9c4BF3C68c126ecF764d';
		$value    = '0x01';
		$chainId  = 3;
		$sSendData = '0x60006000674978815011915260f060005260326000f3';
		$privateKey = '99b3969b60796ddf89480448423420ee2cee807936867885909508b17d0e635a';
		#31a24edad8548ae2ab963156c2ec15b8480fd66e4c3e39278e2247ed5c6ac035 
		#0x02CC64973a38A82A446A9c4BF3C68c126ecF764d
		#9c20c00af708be5f1870e138d48c96eaa54e5eea406194d9f1405bf3793c488f 
		#0x23A14e97A59779165BF83310a712B84F101c9140
		#99b3969b60796ddf89480448423420ee2cee807936867885909508b17d0e635a 
		#0x2DFe5B0D283B81AA88D77083C9FBA195B2eF3bA1
		#( $nonce = '',  $gasPrice = '',  $gasLimit = '',  $to = '',  $value = '',  $data = '') 
		
		$transaction = new Transaction ($nonce, $gasPrice, $gasLimit, $to, $value, $sSendData);
		$sResultData = $transaction->getRaw ($privateKey, $chainId);
		// f86d048503f5476a0083027f4b941a8c8adfbe1c59e8b58cc0d515f07b7225f51c72882a45907d1bef7c008025a0db4efcc22a7d9b2cab180ce37f81959412594798cb9af7c419abb6323763cdd5a0631a0c47d27e5b6e3906a419de2d732e290b73ead4172d8598ce4799c13bda69
		// f850048080808087600060006009f025a0fa47e482938932e7d78da5b267d4bb6b6092ea59fd9784601b484aa292a14444a0521c528e77afffbef7f6838274ab8417cf23081ce1c875d73c717ecc66cc1564
		// f853048083989680808087600060006009f029a0679449c12cbd048416454d0fc655708d07dd3e3e922dd2111ad68c5d441a5eaca0511695e61d07818b16af21a0e3088d8f0401381360efef34f632303783022c45
		#var_dump($sResultData);
		
		
		#'{"method":"eth_sign","params":["0xcd2a3d9f938e13cd947ec05abc7fe734df8dd826","0x5363686f6f6c627573"],"id":1,"jsonrpc":"2.0"}'
		#$sSendFrom = "0x02CC64973a38A82A446A9c4BF3C68c126ecF764d";
		#$sSendTo = ""; #"0xd46e8dd67c5d32be8058bb8eb970870f07244567";
		#$sSendData = "0x600060006008f0"; #xd46e8dd67c5d32be8d46e8dd67c5d32be8058bb8eb970870f072445675058bb8eb970870f072445675
		
		$sRawTransaction = '{"method":"eth_sendRawTransaction",
		"params":[
			"0x'. $sResultData .'"
		],
		"id":1,
		"jsonrpc":"2.0"}';
		$sResultRequest = $this->rpc_request($sRawTransaction);
		
		var_dump(["eth_sendRawTransaction: ", $sResultRequest]);
		$fileLog = 'people.log';
		file_put_contents($fileLog, ($sResultRequest.PHP_EOL), FILE_APPEND | LOCK_EX);
		
		
		
		// Contract address after transaction
		$aTransactionHash = json_decode($sResultRequest, true);
		var_dump($aTransactionHash);
		if (isset($aTransactionHash['result']))
		$sTransactionHash = $aTransactionHash['result'];
		else $sTransactionHash = "0xdf4f4421fc0691995bafb0b88129ada30741feeb98c68339735c44c4a2d735e9";
		#$sTransactionHash = "0x4cf9f9c37424d9287edb61fe64065dfdbefa92e49c78eb5ed0716d844d668759";
		$sContractAddress = '{"method":"eth_getTransactionReceipt","params":["'. $sTransactionHash .'"],"id":1,"jsonrpc":"2.0"}';
		$sResultRequest = $this->rpc_request($sContractAddress);
		
		var_dump(["sResultRequest: ", $sResultRequest]);
		var_dump(["eth_getTransactionReceipt: ", $sResultRequest]);
		$fileLog = 'people.log';
		file_put_contents($fileLog, ($sResultRequest.PHP_EOL), FILE_APPEND | LOCK_EX);
		
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