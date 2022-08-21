<?php
namespace App\Suiteziel\End;


use Web3\Web3;



class Transport
{

	public function __construct () {
    $web3 = new Web3('http://127.0.0.1:8545');
    $accounts = $web3->eth()->accounts(); // ['0x54a3259f4f693e4c1e9daa54eb116a0701edc403', ...]

    var_dump($accounts);
	}

	private function rpc_client($o){}
	private function rpc_server($o){}
}

?>