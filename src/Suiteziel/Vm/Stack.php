<?php
namespace App\Suiteziel\Vm;

class Stack
{
	//public $iCursor;
	public $aHex;
	public $aaStack;
	public $aArguments;
		
	public function __construct () {
		$this->iCursor = 0;
		$this->aaStack = array();
		$this->aArguments = array();
	}

	public function stack_set ($aHex = null): bool {
		$this->aHex = $aHex;
		return true;
	}

	public function initiate ($iKey = null, $sHex = null): bool {
		$iKey = $iKey + 1;
		//$this->arguments_set(array());
		
		switch ($sHex) {
			case 0x00: $this->aArguments = array_slice($this->aHex, $iKey, 0); break; //STOP
			case 0x01: $this->aArguments = array_slice($this->aHex, $iKey, 2); break; //ADD
			case 0x02: $this->aArguments = array_slice($this->aHex, $iKey, 2); break; //MUL
			case 0x03: $this->aArguments = array_slice($this->aHex, $iKey, 2); break; //SUB
			case 0x04: $this->aArguments = array_slice($this->aHex, $iKey, 2); break; //DIV
			case 0x05: $this->aArguments = array_slice($this->aHex, $iKey, 2); break; //SDIV
			case 0x06: $this->aArguments = array_slice($this->aHex, $iKey, 2); break; //MOD
			case 0x07: $this->aArguments = array_slice($this->aHex, $iKey, 2); break; //SMOD
			case 0x08: $this->aArguments = array_slice($this->aHex, $iKey, 3); break; //ADDMOD
			case 0x09: $this->aArguments = array_slice($this->aHex, $iKey, 3); break; //MULMOD
			case 0x0a: $this->aArguments = array_slice($this->aHex, $iKey, 2); break; //EXP
			case 0x0b: $this->aArguments = array_slice($this->aHex, $iKey, 2); break; //SIGNEXTEND
			case 0x10: $this->aArguments = array_slice($this->aHex, $iKey, 2); break; //LT
			case 0x11: $this->aArguments = array_slice($this->aHex, $iKey, 2); break; //GT
			case 0x12: $this->aArguments = array_slice($this->aHex, $iKey, 2); break; //SLT
			case 0x13: $this->aArguments = array_slice($this->aHex, $iKey, 2); break; //SGT
			case 0x14: $this->aArguments = array_slice($this->aHex, $iKey, 2); break; //EQ
			case 0x15: $this->aArguments = array_slice($this->aHex, $iKey, 2); break; //ISZERO
			case 0x16: $this->aArguments = array_slice($this->aHex, $iKey, 2); break; //AND
			case 0x17: $this->aArguments = array_slice($this->aHex, $iKey, 2); break; //OR
			case 0x18: $this->aArguments = array_slice($this->aHex, $iKey, 2); break; //XOR
			case 0x19: $this->aArguments = array_slice($this->aHex, $iKey, 1); break; //NOT
			case 0x1a: $this->aArguments = array_slice($this->aHex, $iKey, 2); break; //BYTE
			case 0x20: $this->aArguments = array_slice($this->aHex, $iKey, 2); break; //SHA3
			case 0x30: $this->aArguments = array_slice($this->aHex, $iKey, 0); break; //ADDRESS
			case 0x31: $this->aArguments = array_slice($this->aHex, $iKey, 1); break; //BALANCE
			case 0x32: $this->aArguments = array_slice($this->aHex, $iKey, 0); break; //ORIGIN
			case 0x33: $this->aArguments = array_slice($this->aHex, $iKey, 0); break; //CALLER
			case 0x34: $this->aArguments = array_slice($this->aHex, $iKey, 0); break; //CALLVALUE
			case 0x35: $this->aArguments = array_slice($this->aHex, $iKey, 1); break; //CALLDATALOAD
			case 0x36: $this->aArguments = array_slice($this->aHex, $iKey, 0); break; //CALLDATASIZE
			case 0x37: $this->aArguments = array_slice($this->aHex, $iKey, 3); break; //CALLDATACOPY
			case 0x38: $this->aArguments = array_slice($this->aHex, $iKey, 0); break; //CODESIZE
			case 0x39: $this->aArguments = array_slice($this->aHex, $iKey, 3); break; //CODECOPY
			case 0x3a: $this->aArguments = array_slice($this->aHex, $iKey, 0); break; //GASPRICE
			case 0x3b: $this->aArguments = array_slice($this->aHex, $iKey, 1); break; //EXTCODESIZE
			case 0x3c: $this->aArguments = array_slice($this->aHex, $iKey, 3); break; //EXTCODECOPY
			case 0x40: $this->aArguments = array_slice($this->aHex, $iKey, 1); break; //BLOCKHASH
			case 0x41: $this->aArguments = array_slice($this->aHex, $iKey, 0); break; //COINBASE
			case 0x42: $this->aArguments = array_slice($this->aHex, $iKey, 0); break; //TIMESTAMP
			case 0x43: $this->aArguments = array_slice($this->aHex, $iKey, 0); break; //NUMBER
			case 0x44: $this->aArguments = array_slice($this->aHex, $iKey, 0); break; //DIFFICULTY
			case 0x45: $this->aArguments = array_slice($this->aHex, $iKey, 0); break; //GASLIMIT
			case 0x46: $this->aArguments = array_slice($this->aHex, $iKey, 0); break; //CHAINID
			case 0x47: $this->aArguments = array_slice($this->aHex, $iKey, 0); break; //SELFBALANCE
			case 0x48: $this->aArguments = array_slice($this->aHex, $iKey, 0); break; //BASEFEE
			case 0x50: $this->aArguments = array_slice($this->aHex, $iKey, 1); break; //POP
			case 0x51: $this->aArguments = array_slice($this->aHex, $iKey, 1); break; //MLOAD
			case 0x52: $this->aArguments = array_slice($this->aHex, $iKey, 2); break; //MSTORE
			case 0x53: $this->aArguments = array_slice($this->aHex, $iKey, 2); break; //MSTORE8
			case 0x54: $this->aArguments = array_slice($this->aHex, $iKey, 1); break; //SLOAD
			case 0x55: $this->aArguments = array_slice($this->aHex, $iKey, 2); break; //SSTORE
			case 0x56: $this->aArguments = array_slice($this->aHex, $iKey, 1); break; //JUMP
			case 0x57: $this->aArguments = array_slice($this->aHex, $iKey, 2); break; //JUMPI
			case 0x58: $this->aArguments = array_slice($this->aHex, $iKey, 1); break; //PC
			case 0x59: $this->aArguments = array_slice($this->aHex, $iKey, 1); break; //MSIZE
			case 0x5a: $this->aArguments = array_slice($this->aHex, $iKey, 1); break; //GAS
			case 0x5b: $this->aArguments = array_slice($this->aHex, $iKey, 1); break; //JUMPDEST
			case 0x60: 
				$this->aArguments = array_slice($this->aHex, $iKey, 1);
				
				break; //PUSH1
			case 0x61: $this->aArguments = array_slice($this->aHex, $iKey, 2); break; //PUSH2
			case 0x62: $this->aArguments = array_slice($this->aHex, $iKey, 3); break; //PUSH3
			case 0x63: $this->aArguments = array_slice($this->aHex, $iKey, 4); break; //PUSH4
			case 0x64: $this->aArguments = array_slice($this->aHex, $iKey, 5); break; //PUSH5
			case 0x65: $this->aArguments = array_slice($this->aHex, $iKey, 6); break; //PUSH6
			case 0x66: $this->aArguments = array_slice($this->aHex, $iKey, 7); break; //PUSH7
			case 0x67: $this->aArguments = array_slice($this->aHex, $iKey, 8); break; //PUSH8
			case 0x68: $this->aArguments = array_slice($this->aHex, $iKey, 9); break; //PUSH9
			case 0x69: $this->aArguments = array_slice($this->aHex, $iKey, 10); break; //PUSH10
			case 0x6a: $this->aArguments = array_slice($this->aHex, $iKey, 11); break; //PUSH11
			case 0x6b: $this->aArguments = array_slice($this->aHex, $iKey, 12); break; //PUSH12
			case 0x6c: $this->aArguments = array_slice($this->aHex, $iKey, 13); break; //PUSH13
			case 0x6d: $this->aArguments = array_slice($this->aHex, $iKey, 14); break; //PUSH14
			case 0x6e: $this->aArguments = array_slice($this->aHex, $iKey, 15); break; //PUSH15
			case 0x6f: $this->aArguments = array_slice($this->aHex, $iKey, 16); break; //PUSH16
			case 0x70: $this->aArguments = array_slice($this->aHex, $iKey, 17); break; //PUSH17
			case 0x71: $this->aArguments = array_slice($this->aHex, $iKey, 18); break; //PUSH18
			case 0x72: $this->aArguments = array_slice($this->aHex, $iKey, 19); break; //PUSH19
			case 0x73: $this->aArguments = array_slice($this->aHex, $iKey, 20); break; //PUSH20
			case 0x74: $this->aArguments = array_slice($this->aHex, $iKey, 21); break; //PUSH21
			case 0x75: $this->aArguments = array_slice($this->aHex, $iKey, 22); break; //PUSH22
			case 0x76: $this->aArguments = array_slice($this->aHex, $iKey, 23); break; //PUSH23
			case 0x77: $this->aArguments = array_slice($this->aHex, $iKey, 24); break; //PUSH24
			case 0x78: $this->aArguments = array_slice($this->aHex, $iKey, 25); break; //PUSH25
			case 0x79: $this->aArguments = array_slice($this->aHex, $iKey, 26); break; //PUSH26
			case 0x7a: $this->aArguments = array_slice($this->aHex, $iKey, 27); break; //PUSH27
			case 0x7b: $this->aArguments = array_slice($this->aHex, $iKey, 28); break; //PUSH28
			case 0x7c: $this->aArguments = array_slice($this->aHex, $iKey, 29); break; //PUSH29
			case 0x7d: $this->aArguments = array_slice($this->aHex, $iKey, 30); break; //PUSH30
			case 0x7e: $this->aArguments = array_slice($this->aHex, $iKey, 31); break; //PUSH31
			case 0x7f: $this->aArguments = array_slice($this->aHex, $iKey, 32); break; //PUSH32
			case 0x80: $this->aArguments = array_slice($this->aHex, $iKey, 1); break; //DUP1
			case 0x81: $this->aArguments = array_slice($this->aHex, $iKey, 2); break; //DUP2
			case 0x82: $this->aArguments = array_slice($this->aHex, $iKey, 3); break; //DUP3
			case 0x83: $this->aArguments = array_slice($this->aHex, $iKey, 4); break; //DUP4
			case 0x84: $this->aArguments = array_slice($this->aHex, $iKey, 5); break; //DUP5
			case 0x85: $this->aArguments = array_slice($this->aHex, $iKey, 6); break; //DUP6
			case 0x86: $this->aArguments = array_slice($this->aHex, $iKey, 7); break; //DUP7
			case 0x87: $this->aArguments = array_slice($this->aHex, $iKey, 8); break; //DUP8
			case 0x88: $this->aArguments = array_slice($this->aHex, $iKey, 9); break; //DUP9
			case 0x89: $this->aArguments = array_slice($this->aHex, $iKey, 10); break; //DUP10
			case 0x8a: $this->aArguments = array_slice($this->aHex, $iKey, 11); break; //DUP11
			case 0x8b: $this->aArguments = array_slice($this->aHex, $iKey, 12); break; //DUP12
			case 0x8c: $this->aArguments = array_slice($this->aHex, $iKey, 13); break; //DUP13
			case 0x8d: $this->aArguments = array_slice($this->aHex, $iKey, 14); break; //DUP14
			case 0x8e: $this->aArguments = array_slice($this->aHex, $iKey, 15); break; //DUP15
			case 0x8f: $this->aArguments = array_slice($this->aHex, $iKey, 16); break; //DUP16
			case 0x90: $this->aArguments = array_slice($this->aHex, $iKey, 1); break; //SWAP1
			case 0x91: $this->aArguments = array_slice($this->aHex, $iKey, 2); break; //SWAP2
			case 0x92: $this->aArguments = array_slice($this->aHex, $iKey, 3); break; //SWAP3
			case 0x93: $this->aArguments = array_slice($this->aHex, $iKey, 4); break; //SWAP4
			case 0x94: $this->aArguments = array_slice($this->aHex, $iKey, 5); break; //SWAP5
			case 0x95: $this->aArguments = array_slice($this->aHex, $iKey, 6); break; //SWAP6
			case 0x96: $this->aArguments = array_slice($this->aHex, $iKey, 7); break; //SWAP7
			case 0x97: $this->aArguments = array_slice($this->aHex, $iKey, 8); break; //SWAP8
			case 0x98: $this->aArguments = array_slice($this->aHex, $iKey, 9); break; //SWAP9
			case 0x99: $this->aArguments = array_slice($this->aHex, $iKey, 10); break; //SWAP10
			case 0x9a: $this->aArguments = array_slice($this->aHex, $iKey, 11); break; //SWAP11
			case 0x9b: $this->aArguments = array_slice($this->aHex, $iKey, 12); break; //SWAP12
			case 0x9c: $this->aArguments = array_slice($this->aHex, $iKey, 13); break; //SWAP13
			case 0x9d: $this->aArguments = array_slice($this->aHex, $iKey, 14); break; //SWAP14
			case 0x9e: $this->aArguments = array_slice($this->aHex, $iKey, 15); break; //SWAP15
			case 0x9f: $this->aArguments = array_slice($this->aHex, $iKey, 16); break; //SWAP16
			case 0xa0: $this->aArguments = array_slice($this->aHex, $iKey, 2); break; //LOG0
			case 0xa1: $this->aArguments = array_slice($this->aHex, $iKey, 3); break; //LOG1
			case 0xa2: $this->aArguments = array_slice($this->aHex, $iKey, 4); break; //LOG2
			case 0xa3: $this->aArguments = array_slice($this->aHex, $iKey, 5); break; //LOG3
			case 0xa4: $this->aArguments = array_slice($this->aHex, $iKey, 6); break; //LOG4
			case 0xf0: $this->aArguments = array_slice($this->aHex, $iKey, 3); break; //CREATE
			case 0xf1: $this->aArguments = array_slice($this->aHex, $iKey, 7); break; //CALL
			case 0xf2: $this->aArguments = array_slice($this->aHex, $iKey, 7); break; //CALLCODE
			case 0xf3: $this->aArguments = array_slice($this->aHex, $iKey, 2); break; //RETURN
			case 0xf4: $this->aArguments = array_slice($this->aHex, $iKey, 6); break; //DELEGATECALL
			case 0xfe: $this->aArguments = array_slice($this->aHex, $iKey, 0); break; //INVALID
			case 0xff: $this->aArguments = array_slice($this->aHex, $iKey, 1); break; //SELFDESTRUCT

		}
		return true;
	}

	public function arguments_get(): array {//$iKey = null, $aArguments = null): int {
		//$iKeyLeft = null;
		return $this->aArguments;
	}
		
	public function arguments_set($aArguments) {//$iKey = null, $aArguments = null): int {
		//$iKeyLeft = null;
		$this->aArguments = $aArguments;
	}
	public function test() {
		return  "Hello woorld Stack";
	}
}

?>