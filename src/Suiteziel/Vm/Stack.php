<?php
namespace App\Suiteziel\Vm;

use Ds;

class Stack
{
	public function __construct() {
		$stack = new \Ds\Stack();
		print_r($stack);
	}

	public function test() {
		return  "Hello woorld Stack";
	}
}

/*
opcodes vm memory stack parameters test
*/
?>