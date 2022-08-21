<?php
namespace App\Suiteziel\End;


use Web3\Web3;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;


class Transport
{

	public function __construct () {
    
    $web3 = new Web3(new HttpProvider(new HttpRequestManager('http://localhost:8545')));
	}

	private function rpc_client(o){}
	private function rpc_server(o){}
}

?>