<?php
namespace App\Suiteziel\Vm;


class Opcodes
{
	//public $iCursor;
	public $aHex;
	public $aaStack;
	public $aArguments;
	public $aaOpcodes;
	
	public function __construct () {
		$this->iCursor = 0;
		$this->aaStack = array();
		$this->aArguments = array();
		$this->set_opcodes();
	}
	
	public function set_opcodes () {
		$this->aaOpcodes = array(
			0x00 => array(0, 0, 0x00, "STOP", "Halts execution"),
			0x01 => array(0, 3, 0x01, "ADD", "Addition operation"),
			0x02 => array(0, 5, 0x02, "MUL", "Multiplication operation"),
			0x03 => array(0, 3, 0x03, "SUB", "Subtraction operation"),
			0x04 => array(0, 5, 0x04, "DIV", "Integer division operation"),
			0x05 => array(0, 5, 0x05, "SDIV", "Signed integer division operation (truncated)"),
			0x06 => array(0, 5, 0x06, "MOD", "Modulo remainder operation"),
			0x07 => array(0, 5, 0x07, "SMOD", "Signed modulo remainder operation"),
			0x08 => array(0, 8, 0x08, "ADDMOD", "Modulo addition operation"),
			0x09 => array(0, 8, 0x09, "MULMOD", "Modulo multiplication operation"),
			0x0a => array(0, 10, 0x0a, "EXP", "Exponential operation"),
			0x0b => array(0, 5, 0x0b, "SIGNEXTEND", "Extend length of two’s complement signed integer"),
			0x10 => array(0, 3, 0x10, "LT", "Less-than comparison"),
			0x11 => array(0, 3, 0x11, "GT", "Greater-than comparison"),
			0x12 => array(0, 3, 0x12, "SLT", "Signed less-than comparison"),
			0x13 => array(0, 3, 0x13, "SGT", "Signed greater-than comparison"),
			0x14 => array(0, 3, 0x14, "EQ", "Equality comparison"),
			0x15 => array(0, 3, 0x15, "ISZERO", "Simple not operator"),
			0x16 => array(0, 3, 0x16, "AND", "Bitwise AND operation"),
			0x17 => array(0, 3, 0x17, "OR", "Bitwise OR operation"),
			0x18 => array(0, 3, 0x18, "XOR", "Bitwise XOR operation"),
			0x19 => array(0, 3, 0x19, "NOT", "Bitwise NOT operation"),
			0x1a => array(0, 3, 0x1a, "BYTE", "Retrieve single byte from word"),
			0x1c => array(0, 3, 0x1c, "SHR", "Logical right shift operation"),
			0x20 => array(0, 30, 0x20, "SHA3", "Compute Keccak-256 hash"),
			0x30 => array(0, 2, 0x30, "ADDRESS", "Get address of currently executing account"),
			0x31 => array(0, 20, 0x31, "BALANCE", "Get balance of the given account"),
			0x32 => array(0, 2, 0x32, "ORIGIN", "Get execution origination address"),
			0x33 => array(0, 2, 0x33, "CALLER", "Get caller address"),
			0x34 => array(0, 2, 0x34, "CALLVALUE", "Get deposited value by the instruction/transaction responsible for this execution"),
			0x35 => array(0, 3, 0x35, "CALLDATALOAD", "Get input data of current environment"),
			0x36 => array(0, 2, 0x36, "CALLDATASIZE", "Get size of input data in current environment"),
			0x37 => array(0, 3, 0x37, "CALLDATACOPY", "Copy input data in current environment to memory"),
			0x38 => array(0, 2, 0x38, "CODESIZE", "Get size of code running in current environment"),
			0x39 => array(0, 3, 0x39, "CODECOPY", "Copy code running in current environment to memory"),
			0x3a => array(0, 2, 0x3a, "GASPRICE", "Get price of gas in current environment"),
			0x3b => array(0, 20, 0x3b, "EXTCODESIZE", "Get size of an account’s code"),
			0x3c => array(0, 20, 0x3c, "EXTCODECOPY", "Copy an account’s code to memory"),
			0x40 => array(0, 20, 0x40, "BLOCKHASH", "Get the hash of one of the 256 most recent complete blocks"),
			0x41 => array(0, 2, 0x41, "COINBASE", "Get the block’s beneficiary address"),
			0x42 => array(0, 2, 0x42, "TIMESTAMP", "Get the block’s timestamp"),
			0x43 => array(0, 2, 0x43, "NUMBER", "Get the block’s number"),
			0x44 => array(0, 2, 0x44, "DIFFICULTY", "Get the block’s difficulty"),
			0x45 => array(0, 2, 0x45, "GASLIMIT", "Get the block’s gas limit"),
			0x50 => array(0, 2, 0x50, "POP", "Remove item from stack"),
			0x51 => array(0, 3, 0x51, "MLOAD", "Load word from memory"),
			0x52 => array(0, 3, 0x52, "MSTORE", "Save word to memory"),
			0x53 => array(0, 3, 0x53, "MSTORE8", "Save byte to memory"),
			0x54 => array(0, 50, 0x54, "SLOAD", "Load word from storage"),
			0x55 => array(0, 5000, 0x55, "SSTORE", "Save word to storage"),
			0x56 => array(0, 8, 0x56, "JUMP", "Alter the program counter"),
			0x57 => array(0, 10, 0x57, "JUMPI", "Conditionally alter the program counter"),
			0x58 => array(0, 2, 0x58, "PC", "Get the value of the program counter prior to the increment corresponding to this instruction"),
			0x59 => array(0, 2, 0x59, "MSIZE", "Get the size of active memory in bytes"),
			0x5a => array(0, 2, 0x5a, "GAS", "Get the amount of available gas, including the corresponding reduction for the cost of this instruction"),
			0x5b => array(0, 1, 0x5b, "JUMPDEST", "Mark a valid destination for jumps"),
			0x60 => array(1, 3, 0x60, "PUSH1", "Place 1 byte item on stack"),
			0x61 => array(2, 3, 0x61, "PUSH2", "Place 2 byte item on stack"),
			0x62 => array(3, 3, 0x62, "PUSH3", "Place 3 byte item on stack"),
			0x63 => array(4, 3, 0x63, "PUSH4", "Place 4 byte item on stack"),
			0x64 => array(5, 3, 0x64, "PUSH5", "Place 5 byte item on stack"),
			0x65 => array(6, 3, 0x65, "PUSH6", "Place 6 byte item on stack"),
			0x66 => array(7, 3, 0x66, "PUSH7", "Place 7 byte item on stack"),
			0x67 => array(8, 3, 0x67, "PUSH8", "Place 8 byte item on stack"),
			0x68 => array(9, 3, 0x68, "PUSH9", "Place 9 byte item on stack"),
			0x69 => array(10, 3, 0x69, "PUSH10", "Place 10 byte item on stack"),
			0x6a => array(11, 3, 0x6a, "PUSH11", "Place 11 byte item on stack"),
			0x6b => array(12, 3, 0x6b, "PUSH12", "Place 12 byte item on stack"),
			0x6c => array(13, 3, 0x6c, "PUSH13", "Place 13 byte item on stack"),
			0x6d => array(14, 3, 0x6d, "PUSH14", "Place 14 byte item on stack"),
			0x6e => array(15, 3, 0x6e, "PUSH15", "Place 15 byte item on stack"),
			0x6f => array(16, 3, 0x6f, "PUSH16", "Place 16 byte item on stack"),
			0x70 => array(17, 3, 0x70, "PUSH17", "Place 17 byte item on stack"),
			0x71 => array(18, 3, 0x71, "PUSH18", "Place 18 byte item on stack"),
			0x72 => array(19, 3, 0x72, "PUSH19", "Place 19 byte item on stack"),
			0x73 => array(20, 3, 0x73, "PUSH20", "Place 20 byte item on stack"),
			0x74 => array(21, 3, 0x74, "PUSH21", "Place 21 byte item on stack"),
			0x75 => array(22, 3, 0x75, "PUSH22", "Place 22 byte item on stack"),
			0x76 => array(23, 3, 0x76, "PUSH23", "Place 23 byte item on stack"),
			0x77 => array(24, 3, 0x77, "PUSH24", "Place 24 byte item on stack"),
			0x78 => array(25, 3, 0x78, "PUSH25", "Place 25 byte item on stack"),
			0x79 => array(26, 3, 0x79, "PUSH26", "Place 26 byte item on stack"),
			0x7a => array(27, 3, 0x7a, "PUSH27", "Place 27 byte item on stack"),
			0x7b => array(28, 3, 0x7b, "PUSH28", "Place 28 byte item on stack"),
			0x7c => array(29, 3, 0x7c, "PUSH29", "Place 29 byte item on stack"),
			0x7d => array(30, 3, 0x7d, "PUSH30", "Place 30 byte item on stack"),
			0x7e => array(31, 3, 0x7e, "PUSH31", "Place 31 byte item on stack"),
			0x7f => array(32, 3, 0x7f, "PUSH32", "Place 32 byte (full word) item on stack"),
			0x80 => array(0, 3, 0x80, "DUP1", "Duplicate 1st stack item"),
			0x81 => array(0, 3, 0x81, "DUP2", "Duplicate 2nd stack item"),
			0x82 => array(0, 3, 0x82, "DUP3", "Duplicate 3rd stack item"),
			0x83 => array(0, 3, 0x83, "DUP4", "Duplicate 4th stack item"),
			0x84 => array(0, 3, 0x84, "DUP5", "Duplicate 5th stack item"),
			0x85 => array(0, 3, 0x85, "DUP6", "Duplicate 6th stack item"),
			0x86 => array(0, 3, 0x86, "DUP7", "Duplicate 7th stack item"),
			0x87 => array(0, 3, 0x87, "DUP8", "Duplicate 8th stack item"),
			0x88 => array(0, 3, 0x88, "DUP9", "Duplicate 9th stack item"),
			0x89 => array(0, 3, 0x89, "DUP10", "Duplicate 10th stack item"),
			0x8a => array(0, 3, 0x8a, "DUP11", "Duplicate 11th stack item"),
			0x8b => array(0, 3, 0x8b, "DUP12", "Duplicate 12th stack item"),
			0x8c => array(0, 3, 0x8c, "DUP13", "Duplicate 13th stack item"),
			0x8d => array(0, 3, 0x8d, "DUP14", "Duplicate 14th stack item"),
			0x8e => array(0, 3, 0x8e, "DUP15", "Duplicate 15th stack item"),
			0x8f => array(0, 3, 0x8f, "DUP16", "Duplicate 16th stack item"),
			0x90 => array(0, 3, 0x90, "SWAP1", "Exchange 1st and 2nd stack items"),
			0x91 => array(0, 3, 0x91, "SWAP2", "Exchange 1st and 3rd stack items"),
			0x92 => array(0, 3, 0x92, "SWAP3", "Exchange 1st and 4th stack items"),
			0x93 => array(0, 3, 0x93, "SWAP4", "Exchange 1st and 5th stack items"),
			0x94 => array(0, 3, 0x94, "SWAP5", "Exchange 1st and 6th stack items"),
			0x95 => array(0, 3, 0x95, "SWAP6", "Exchange 1st and 7th stack items"),
			0x96 => array(0, 3, 0x96, "SWAP7", "Exchange 1st and 8th stack items"),
			0x97 => array(0, 3, 0x97, "SWAP8", "Exchange 1st and 9th stack items"),
			0x98 => array(0, 3, 0x98, "SWAP9", "Exchange 1st and 10th stack items"),
			0x99 => array(0, 3, 0x99, "SWAP10", "Exchange 1st and 11th stack items"),
			0x9a => array(0, 3, 0x9a, "SWAP11", "Exchange 1st and 12th stack items"),
			0x9b => array(0, 3, 0x9b, "SWAP12", "Exchange 1st and 13th stack items"),
			0x9c => array(0, 3, 0x9c, "SWAP13", "Exchange 1st and 14th stack items"),
			0x9d => array(0, 3, 0x9d, "SWAP14", "Exchange 1st and 15th stack items"),
			0x9e => array(0, 3, 0x9e, "SWAP15", "Exchange 1st and 16th stack items"),
			0x9f => array(0, 3, 0x9f, "SWAP16", "Exchange 1st and 17th stack items"),
			0xa0 => array(0, 375, 0xa0, "LOG0", "Append log record with no topics"),
			0xa1 => array(0, 750, 0xa1, "LOG1", "Append log record with one topic"),
			0xa2 => array(0, 1125, 0xa2, "LOG2", "Append log record with two topics"),
			0xa3 => array(0, 1500, 0xa3, "LOG3", "Append log record with three topics"),
			0xa4 => array(0, 1875, 0xa4, "LOG4", "Append log record with four topics"),
			0xf0 => array(0, 32000, 0xf0, "CREATE", "Create a new account with associated code"),
			0xf1 => array(0, 40, 0xf1, "CALL", "Message-call into an account"),
			0xf2 => array(0, 40, 0xf2, "CALLCODE", "Message-call into this account with alternative account’s code"),
			0xf3 => array(0, 0, 0xf3, "RETURN", "Halt execution returning output data"),
			0xf4 => array(0, 40, 0xf4, "DELEGATECALL", "Message-call into this account with an alternative account’s code, but persisting the current values for sender and value"),
			0xf5 => array(0, 0, 0xf5, "CREATE2", "Create a new account with associated code."),
			0xfa => array(0, 0, 0xfa, "STATICCALL", "Static message-call into an account."),
			0xfd => array(0, 0, 0xfd, "REVERT", "Halt execution reverting state changes but returning data and remaining gas."),
			0xfe => array(0, 40, 0xfe, "INVALIDL", "Designated invalid instruction"),
			0xff => array(0, 0, 0xff, "SELFDESTRUCT", "Halt execution and register account for later deletion"),
		);
	}

	public function hex_set ($aHex = null) {
		$this->aHex = $aHex;
	}

	public function opcodes ($iKey = null, $sHex = null) {
		switch ($iKey) {
			case 1: return $this->aaOpcodes[$sHex][0]; //arguments
			case 2: return $this->aaOpcodes[$sHex][1]; //price
			case 3: return $this->aaOpcodes[$sHex][2]; //hex name
			case 4: return $this->aaOpcodes[$sHex][3]; //name
			case 5: return $this->aaOpcodes[$sHex][4]; //description
			default: return false;
		}
		return true;
	}
	
	public function initiate ($iKey = null, $sHex = null) :bool {
		$iKey = $iKey + 1;
		//$this->arguments_set(array());
		
		if (!isset($this->aaOpcodes[$sHex])) return false;
		$this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0]);
		
		/*
		
		switch ($sHex) {
			case 0x00: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //STOP
			case 0x01: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //ADD
			case 0x02: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //MUL
			case 0x03: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //SUB
			case 0x04: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //DIV
			case 0x05: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //SDIV
			case 0x06: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //MOD
			case 0x07: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //SMOD
			case 0x08: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //ADDMOD
			case 0x09: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //MULMOD
			case 0x0a: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //EXP
			case 0x0b: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //SIGNEXTEND
			case 0x10: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //LT
			case 0x11: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //GT
			case 0x12: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //SLT
			case 0x13: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //SGT
			case 0x14: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //EQ
			case 0x15: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //ISZERO
			case 0x16: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //AND
			case 0x17: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //OR
			case 0x18: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //XOR
			case 0x19: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //NOT
			case 0x1a: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //BYTE
			case 0x1c: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //SHR
			case 0x20: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //SHA3
			case 0x30: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //ADDRESS
			case 0x31: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //BALANCE
			case 0x32: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //ORIGIN
			case 0x33: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //CALLER
			case 0x34: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //CALLVALUE
			case 0x35: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //CALLDATALOAD
			case 0x36: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //CALLDATASIZE
			case 0x37: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //CALLDATACOPY
			case 0x38: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //CODESIZE
			case 0x39: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //CODECOPY
			case 0x3a: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //GASPRICE
			case 0x3b: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //EXTCODESIZE
			case 0x3c: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //EXTCODECOPY
			case 0x40: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //BLOCKHASH
			case 0x41: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //COINBASE
			case 0x42: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //TIMESTAMP
			case 0x43: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //NUMBER
			case 0x44: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //DIFFICULTY
			case 0x45: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //GASLIMIT
			case 0x46: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //CHAINID
			case 0x47: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //SELFBALANCE
			case 0x48: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //BASEFEE
			case 0x50: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //POP
			case 0x51: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //MLOAD
			case 0x52: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //MSTORE
			case 0x53: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //MSTORE8
			case 0x54: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //SLOAD
			case 0x55: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //SSTORE
			case 0x56: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //JUMP
			case 0x57: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //JUMPI
			case 0x58: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //PC
			case 0x59: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //MSIZE
			case 0x5a: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //GAS
			case 0x5b: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //JUMPDEST
			case 0x60: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //PUSH1
			case 0x61: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //PUSH2
			case 0x62: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //PUSH3
			case 0x63: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //PUSH4
			case 0x64: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //PUSH5
			case 0x65: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //PUSH6
			case 0x66: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //PUSH7
			case 0x67: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //PUSH8
			case 0x68: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //PUSH9
			case 0x69: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //PUSH10
			case 0x6a: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //PUSH11
			case 0x6b: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //PUSH12
			case 0x6c: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //PUSH13
			case 0x6d: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //PUSH14
			case 0x6e: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //PUSH15
			case 0x6f: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //PUSH16
			case 0x70: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //PUSH17
			case 0x71: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //PUSH18
			case 0x72: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //PUSH19
			case 0x73: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //PUSH20
			case 0x74: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //PUSH21
			case 0x75: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //PUSH22
			case 0x76: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //PUSH23
			case 0x77: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //PUSH24
			case 0x78: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //PUSH25
			case 0x79: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //PUSH26
			case 0x7a: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //PUSH27
			case 0x7b: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //PUSH28
			case 0x7c: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //PUSH29
			case 0x7d: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //PUSH30
			case 0x7e: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //PUSH31
			case 0x7f: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //PUSH32
			case 0x80: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //DUP1
			case 0x81: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //DUP2
			case 0x82: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //DUP3
			case 0x83: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //DUP4
			case 0x84: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //DUP5
			case 0x85: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //DUP6
			case 0x86: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //DUP7
			case 0x87: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //DUP8
			case 0x88: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //DUP9
			case 0x89: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //DUP10
			case 0x8a: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //DUP11
			case 0x8b: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //DUP12
			case 0x8c: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //DUP13
			case 0x8d: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //DUP14
			case 0x8e: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //DUP15
			case 0x8f: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //DUP16
			case 0x90: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //SWAP1
			case 0x91: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //SWAP2
			case 0x92: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //SWAP3
			case 0x93: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //SWAP4
			case 0x94: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //SWAP5
			case 0x95: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //SWAP6
			case 0x96: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //SWAP7
			case 0x97: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //SWAP8
			case 0x98: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //SWAP9
			case 0x99: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //SWAP10
			case 0x9a: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //SWAP11
			case 0x9b: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //SWAP12
			case 0x9c: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //SWAP13
			case 0x9d: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //SWAP14
			case 0x9e: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //SWAP15
			case 0x9f: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //SWAP16
			case 0xa0: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //LOG0
			case 0xa1: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //LOG1
			case 0xa2: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //LOG2
			case 0xa3: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //LOG3
			case 0xa4: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //LOG4
			case 0xf0: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //CREATE
			case 0xf1: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //CALL
			case 0xf2: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //CALLCODE
			case 0xf3: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //RETURN
			case 0xf4: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //DELEGATECALL
			case 0xf5: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //CREATE2
			case 0xfa: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //STATICCALL
			case 0xfd: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //REVERT
			case 0xfe: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //INVALID
			case 0xff: $this->aArguments = array_slice($this->aHex, $iKey, $this->aaOpcodes[$sHex][0] ); break; //SELFDESTRUCT
		}
		*/
		return true;
	}

	public function describe($iKey = null, $sHex = null) :bool {
		$sArguments = implode(",", $this->aArguments);
		
		if (!isset($this->aaOpcodes[$sHex])) return false;
		print "$iKey\t$sHex\t#". $this->aaOpcodes[$sHex][2] ."\t0\t". $this->aaOpcodes[$sHex][3] ."\t\t". $this->aaOpcodes[$sHex][4] ."\n";
			
/*
		switch ($sHex) {
			case 0x00: print "$iKey\t$sHex\t# 0x00\t0\tSTOP\t\t".$sArguments."\t\tHalts execution\n"; break;
			case 0x01: print "$iKey\t$sHex\t# 0x01\t3\tADD\t\t".$sArguments."\t\tAddition operation\n"; break;
			case 0x02: print "$iKey\t$sHex\t# 0x02\t5\tMUL\t\t".$sArguments."\t\tMultiplication operation\n"; break;
			case 0x03: print "$iKey\t$sHex\t# 0x03\t3\tSUB\t\t".$sArguments."\t\tSubtraction operation\n"; break;
			case 0x04: print "$iKey\t$sHex\t# 0x04\t5\tDIV\t\t".$sArguments."\t\tInteger division operation\n"; break;
			case 0x05: print "$iKey\t$sHex\t# 0x05\t5\tSDIV\t\t".$sArguments."\t\tSigned integer division operation (truncated)\n"; break;
			case 0x06: print "$iKey\t$sHex\t# 0x06\t5\tMOD\t\t".$sArguments."\t\tModulo remainder operation\n"; break;
			case 0x07: print "$iKey\t$sHex\t# 0x07\t5\tSMOD\t\t".$sArguments."\t\tSigned modulo remainder operation\n"; break;
			case 0x08: print "$iKey\t$sHex\t# 0x08\t8\tADDMOD\t\t".$sArguments."\t\tModulo addition operation\n"; break;
			case 0x09: print "$iKey\t$sHex\t# 0x09\t8\tMULMOD\t\t".$sArguments."\t\tModulo multiplication operation\n"; break;
			case 0x0a: print "$iKey\t$sHex\t# 0x0a\t10\tEXP\t\t".$sArguments."\t\tExponential operation\n"; break;
			case 0x0b: print "$iKey\t$sHex\t# 0x0b\t5\tSIGNEXTEND\t\t".$sArguments."\t\tExtend length of two’s complement signed integer\n"; break;
			case 0x10: print "$iKey\t$sHex\t# 0x10\t3\tLT\t\t".$sArguments."\t\tLess-than comparison\n"; break;
			case 0x11: print "$iKey\t$sHex\t# 0x11\t3\tGT\t\t".$sArguments."\t\tGreater-than comparison\n"; break;
			case 0x12: print "$iKey\t$sHex\t# 0x12\t3\tSLT\t\t".$sArguments."\t\tSigned less-than comparison\n"; break;
			case 0x13: print "$iKey\t$sHex\t# 0x13\t3\tSGT\t\t".$sArguments."\t\tSigned greater-than comparison\n"; break;
			case 0x14: print "$iKey\t$sHex\t# 0x14\t3\tEQ\t\t".$sArguments."\t\tEquality comparison\n"; break;
			case 0x15: print "$iKey\t$sHex\t# 0x15\t3\tISZERO\t\t".$sArguments."\t\tSimple not operator\n"; break;
			case 0x16: print "$iKey\t$sHex\t# 0x16\t3\tAND\t\t".$sArguments."\t\tBitwise AND operation\n"; break;
			case 0x17: print "$iKey\t$sHex\t# 0x17\t3\tOR\t\t".$sArguments."\t\tBitwise OR operation\n"; break;
			case 0x18: print "$iKey\t$sHex\t# 0x18\t3\tXOR\t\t".$sArguments."\t\tBitwise XOR operation\n"; break;
			case 0x19: print "$iKey\t$sHex\t# 0x19\t3\tNOT\t\t".$sArguments."\t\tBitwise NOT operation\n"; break;
			case 0x1a: print "$iKey\t$sHex\t# 0x1a\t3\tBYTE\t\t".$sArguments."\t\tRetrieve single byte from word\n"; break;
			case 0x1c: print "$iKey\t$sHex\t# 0x1a\t3\tSHR\t\t".$sArguments."\t\tLogical right shift operation.\n"; break;
			case 0x20: print "$iKey\t$sHex\t# 0x20\t30\tSHA3\t\t".$sArguments."\t\tCompute Keccak-256 hash\n"; break;
			case 0x30: print "$iKey\t$sHex\t# 0x30\t2\tADDRESS\t\t".$sArguments."\t\tGet address of currently executing account\n"; break;
			case 0x31: print "$iKey\t$sHex\t# 0x31\t20\tBALANCE\t\t".$sArguments."\t\tGet balance of the given account\n"; break;
			case 0x32: print "$iKey\t$sHex\t# 0x32\t2\tORIGIN\t\t".$sArguments."\t\tGet execution origination address\n"; break;
			case 0x33: print "$iKey\t$sHex\t# 0x33\t2\tCALLER\t\t".$sArguments."\t\tGet caller address\n"; break;
			case 0x34: print "$iKey\t$sHex\t# 0x34\t2\tCALLVALUE\t\t".$sArguments."\t\tGet deposited value by the instruction/transaction responsible for this execution\n"; break;
			case 0x35: print "$iKey\t$sHex\t# 0x35\t3\tCALLDATALOAD\t\t".$sArguments."\t\tGet input data of current environment\n"; break;
			case 0x36: print "$iKey\t$sHex\t# 0x36\t2\tCALLDATASIZE\t\t".$sArguments."\t\tGet size of input data in current environment\n"; break;
			case 0x37: print "$iKey\t$sHex\t# 0x37\t3\tCALLDATACOPY\t\t".$sArguments."\t\tCopy input data in current environment to memory\n"; break;
			case 0x38: print "$iKey\t$sHex\t# 0x38\t2\tCODESIZE\t\t".$sArguments."\t\tGet size of code running in current environment\n"; break;
			case 0x39: print "$iKey\t$sHex\t# 0x39\t3\tCODECOPY\t\t".$sArguments."\t\tCopy code running in current environment to memory\n"; break;
			case 0x3a: print "$iKey\t$sHex\t# 0x3a\t2\tGASPRICE\t\t".$sArguments."\t\tGet price of gas in current environment\n"; break;
			case 0x3b: print "$iKey\t$sHex\t# 0x3b\t20\tEXTCODESIZE\t\t".$sArguments."\t\tGet size of an account’s code\n"; break;
			case 0x3c: print "$iKey\t$sHex\t# 0x3c\t20\tEXTCODECOPY\t\t".$sArguments."\t\tCopy an account’s code to memory\n"; break;
			case 0x40: print "$iKey\t$sHex\t# 0x40\t20\tBLOCKHASH\t\t".$sArguments."\t\tGet the hash of one of the 256 most recent complete blocks\n"; break;
			case 0x41: print "$iKey\t$sHex\t# 0x41\t2\tCOINBASE\t\t".$sArguments."\t\tGet the block’s beneficiary address\n"; break;
			case 0x42: print "$iKey\t$sHex\t# 0x42\t2\tTIMESTAMP\t\t".$sArguments."\t\tGet the block’s timestamp\n"; break;
			case 0x43: print "$iKey\t$sHex\t# 0x43\t2\tNUMBER\t\t".$sArguments."\t\tGet the block’s number\n"; break;
			case 0x44: print "$iKey\t$sHex\t# 0x44\t2\tDIFFICULTY\t\t".$sArguments."\t\tGet the block’s difficulty\n"; break;
			case 0x45: print "$iKey\t$sHex\t# 0x45\t2\tGASLIMIT\t\t".$sArguments."\t\tGet the block’s gas limit\n"; break;
			case 0x50: print "$iKey\t$sHex\t# 0x50\t2\tPOP\t\t".$sArguments."\t\tRemove item from stack\n"; break;
			case 0x51: print "$iKey\t$sHex\t# 0x51\t3\tMLOAD\t\t".$sArguments."\t\tLoad word from memory\n"; break;
			case 0x52: print "$iKey\t$sHex\t# 0x52\t3\tMSTORE\t\t".$sArguments."\t\tSave word to memory\n"; break;
			case 0x53: print "$iKey\t$sHex\t# 0x53\t3\tMSTORE8\t\t".$sArguments."\t\tSave byte to memory\n"; break;
			case 0x54: print "$iKey\t$sHex\t# 0x54\t50\tSLOAD\t\t".$sArguments."\t\tLoad word from storage\n"; break;
			case 0x55: print "$iKey\t$sHex\t# 0x55\t5000\tSSTORE\t\t".$sArguments."\t\tSave word to storage\n"; break;
			case 0x56: print "$iKey\t$sHex\t# 0x56\t8\tJUMP\t\t".$sArguments."\t\tAlter the program counter\n"; break;
			case 0x57: print "$iKey\t$sHex\t# 0x57\t10\tJUMPI\t\t".$sArguments."\t\tConditionally alter the program counter\n"; break;
			case 0x58: print "$iKey\t$sHex\t# 0x58\t2\tPC\t\t".$sArguments."\t\tGet the value of the program counter prior to the increment corresponding to this instruction\n"; break;
			case 0x59: print "$iKey\t$sHex\t# 0x59\t2\tMSIZE\t\t".$sArguments."\t\tGet the size of active memory in bytes\n"; break;
			case 0x5a: print "$iKey\t$sHex\t# 0x5a\t2\tGAS\t\t".$sArguments."\t\tGet the amount of available gas, including the corresponding reduction for the cost of this instruction\n"; break;
			case 0x5b: print "$iKey\t$sHex\t# 0x5b\t1\tJUMPDEST\t\t".$sArguments."\t\tMark a valid destination for jumps\n"; break;
			case 0x60: print "$iKey\t$sHex\t# 0x60\t3\tPUSH1\t\t".$sArguments."\t\tPlace 1 byte item on stack\n"; break;
			case 0x61: print "$iKey\t$sHex\t# 0x61\t3\tPUSH2\t\t".$sArguments."\t\tPlace 2 byte item on stack\n"; break;
			case 0x62: print "$iKey\t$sHex\t# 0x62\t3\tPUSH3\t\t".$sArguments."\t\tPlace 3 byte item on stack\n"; break;
			case 0x63: print "$iKey\t$sHex\t# 0x63\t3\tPUSH4\t\t".$sArguments."\t\tPlace 4 byte item on stack\n"; break;
			case 0x64: print "$iKey\t$sHex\t# 0x64\t3\tPUSH5\t\t".$sArguments."\t\tPlace 5 byte item on stack\n"; break;
			case 0x65: print "$iKey\t$sHex\t# 0x65\t3\tPUSH6\t\t".$sArguments."\t\tPlace 6 byte item on stack\n"; break;
			case 0x66: print "$iKey\t$sHex\t# 0x66\t3\tPUSH7\t\t".$sArguments."\t\tPlace 7 byte item on stack\n"; break;
			case 0x67: print "$iKey\t$sHex\t# 0x67\t3\tPUSH8\t\t".$sArguments."\t\tPlace 8 byte item on stack\n"; break;
			case 0x68: print "$iKey\t$sHex\t# 0x68\t3\tPUSH9\t\t".$sArguments."\t\tPlace 9 byte item on stack\n"; break;
			case 0x69: print "$iKey\t$sHex\t# 0x69\t3\tPUSH10\t\t".$sArguments."\t\tPlace 10 byte item on stack\n"; break;
			case 0x6a: print "$iKey\t$sHex\t# 0x6a\t3\tPUSH11\t\t".$sArguments."\t\tPlace 11 byte item on stack\n"; break;
			case 0x6b: print "$iKey\t$sHex\t# 0x6b\t3\tPUSH12\t\t".$sArguments."\t\tPlace 12 byte item on stack\n"; break;
			case 0x6c: print "$iKey\t$sHex\t# 0x6c\t3\tPUSH13\t\t".$sArguments."\t\tPlace 13 byte item on stack\n"; break;
			case 0x6d: print "$iKey\t$sHex\t# 0x6d\t3\tPUSH14\t\t".$sArguments."\t\tPlace 14 byte item on stack\n"; break;
			case 0x6e: print "$iKey\t$sHex\t# 0x6e\t3\tPUSH15\t\t".$sArguments."\t\tPlace 15 byte item on stack\n"; break;
			case 0x6f: print "$iKey\t$sHex\t# 0x6f\t3\tPUSH16\t\t".$sArguments."\t\tPlace 16 byte item on stack\n"; break;
			case 0x70: print "$iKey\t$sHex\t# 0x70\t3\tPUSH17\t\t".$sArguments."\t\tPlace 17 byte item on stack\n"; break;
			case 0x71: print "$iKey\t$sHex\t# 0x71\t3\tPUSH18\t\t".$sArguments."\t\tPlace 18 byte item on stack\n"; break;
			case 0x72: print "$iKey\t$sHex\t# 0x72\t3\tPUSH19\t\t".$sArguments."\t\tPlace 19 byte item on stack\n"; break;
			case 0x73: print "$iKey\t$sHex\t# 0x73\t3\tPUSH20\t\t".$sArguments."\t\tPlace 20 byte item on stack\n"; break;
			case 0x74: print "$iKey\t$sHex\t# 0x74\t3\tPUSH21\t\t".$sArguments."\t\tPlace 21 byte item on stack\n"; break;
			case 0x75: print "$iKey\t$sHex\t# 0x75\t3\tPUSH22\t\t".$sArguments."\t\tPlace 22 byte item on stack\n"; break;
			case 0x76: print "$iKey\t$sHex\t# 0x76\t3\tPUSH23\t\t".$sArguments."\t\tPlace 23 byte item on stack\n"; break;
			case 0x77: print "$iKey\t$sHex\t# 0x77\t3\tPUSH24\t\t".$sArguments."\t\tPlace 24 byte item on stack\n"; break;
			case 0x78: print "$iKey\t$sHex\t# 0x78\t3\tPUSH25\t\t".$sArguments."\t\tPlace 25 byte item on stack\n"; break;
			case 0x79: print "$iKey\t$sHex\t# 0x79\t3\tPUSH26\t\t".$sArguments."\t\tPlace 26 byte item on stack\n"; break;
			case 0x7a: print "$iKey\t$sHex\t# 0x7a\t3\tPUSH27\t\t".$sArguments."\t\tPlace 27 byte item on stack\n"; break;
			case 0x7b: print "$iKey\t$sHex\t# 0x7b\t3\tPUSH28\t\t".$sArguments."\t\tPlace 28 byte item on stack\n"; break;
			case 0x7c: print "$iKey\t$sHex\t# 0x7c\t3\tPUSH29\t\t".$sArguments."\t\tPlace 29 byte item on stack\n"; break;
			case 0x7d: print "$iKey\t$sHex\t# 0x7d\t3\tPUSH30\t\t".$sArguments."\t\tPlace 30 byte item on stack\n"; break;
			case 0x7e: print "$iKey\t$sHex\t# 0x7e\t3\tPUSH31\t\t".$sArguments."\t\tPlace 31 byte item on stack\n"; break;
			case 0x7f: print "$iKey\t$sHex\t# 0x7f\t3\tPUSH32\t\t".$sArguments."\t\tPlace 32 byte (full word) item on stack\n"; break;
			case 0x80: print "$iKey\t$sHex\t# 0x80\t3\tDUP1\t\t".$sArguments."\t\tDuplicate 1st stack item\n"; break;
			case 0x81: print "$iKey\t$sHex\t# 0x81\t3\tDUP2\t\t".$sArguments."\t\tDuplicate 2nd stack item\n"; break;
			case 0x82: print "$iKey\t$sHex\t# 0x82\t3\tDUP3\t\t".$sArguments."\t\tDuplicate 3rd stack item\n"; break;
			case 0x83: print "$iKey\t$sHex\t# 0x83\t3\tDUP4\t\t".$sArguments."\t\tDuplicate 4th stack item\n"; break;
			case 0x84: print "$iKey\t$sHex\t# 0x84\t3\tDUP5\t\t".$sArguments."\t\tDuplicate 5th stack item\n"; break;
			case 0x85: print "$iKey\t$sHex\t# 0x85\t3\tDUP6\t\t".$sArguments."\t\tDuplicate 6th stack item\n"; break;
			case 0x86: print "$iKey\t$sHex\t# 0x86\t3\tDUP7\t\t".$sArguments."\t\tDuplicate 7th stack item\n"; break;
			case 0x87: print "$iKey\t$sHex\t# 0x87\t3\tDUP8\t\t".$sArguments."\t\tDuplicate 8th stack item\n"; break;
			case 0x88: print "$iKey\t$sHex\t# 0x88\t3\tDUP9\t\t".$sArguments."\t\tDuplicate 9th stack item\n"; break;
			case 0x89: print "$iKey\t$sHex\t# 0x89\t3\tDUP10\t\t".$sArguments."\t\tDuplicate 10th stack item\n"; break;
			case 0x8a: print "$iKey\t$sHex\t# 0x8a\t3\tDUP11\t\t".$sArguments."\t\tDuplicate 11th stack item\n"; break;
			case 0x8b: print "$iKey\t$sHex\t# 0x8b\t3\tDUP12\t\t".$sArguments."\t\tDuplicate 12th stack item\n"; break;
			case 0x8c: print "$iKey\t$sHex\t# 0x8c\t3\tDUP13\t\t".$sArguments."\t\tDuplicate 13th stack item\n"; break;
			case 0x8d: print "$iKey\t$sHex\t# 0x8d\t3\tDUP14\t\t".$sArguments."\t\tDuplicate 14th stack item\n"; break;
			case 0x8e: print "$iKey\t$sHex\t# 0x8e\t3\tDUP15\t\t".$sArguments."\t\tDuplicate 15th stack item\n"; break;
			case 0x8f: print "$iKey\t$sHex\t# 0x8f\t3\tDUP16\t\t".$sArguments."\t\tDuplicate 16th stack item\n"; break;
			case 0x90: print "$iKey\t$sHex\t# 0x90\t3\tSWAP1\t\t".$sArguments."\t\tExchange 1st and 2nd stack items\n"; break;
			case 0x91: print "$iKey\t$sHex\t# 0x91\t3\tSWAP2\t\t".$sArguments."\t\tExchange 1st and 3rd stack items\n"; break;
			case 0x92: print "$iKey\t$sHex\t# 0x92\t3\tSWAP3\t\t".$sArguments."\t\tExchange 1st and 4th stack items\n"; break;
			case 0x93: print "$iKey\t$sHex\t# 0x93\t3\tSWAP4\t\t".$sArguments."\t\tExchange 1st and 5th stack items\n"; break;
			case 0x94: print "$iKey\t$sHex\t# 0x94\t3\tSWAP5\t\t".$sArguments."\t\tExchange 1st and 6th stack items\n"; break;
			case 0x95: print "$iKey\t$sHex\t# 0x95\t3\tSWAP6\t\t".$sArguments."\t\tExchange 1st and 7th stack items\n"; break;
			case 0x96: print "$iKey\t$sHex\t# 0x96\t3\tSWAP7\t\t".$sArguments."\t\tExchange 1st and 8th stack items\n"; break;
			case 0x97: print "$iKey\t$sHex\t# 0x97\t3\tSWAP8\t\t".$sArguments."\t\tExchange 1st and 9th stack items\n"; break;
			case 0x98: print "$iKey\t$sHex\t# 0x98\t3\tSWAP9\t\t".$sArguments."\t\tExchange 1st and 10th stack items\n"; break;
			case 0x99: print "$iKey\t$sHex\t# 0x99\t3\tSWAP10\t\t".$sArguments."\t\tExchange 1st and 11th stack items\n"; break;
			case 0x9a: print "$iKey\t$sHex\t# 0x9a\t3\tSWAP11\t\t".$sArguments."\t\tExchange 1st and 12th stack items\n"; break;
			case 0x9b: print "$iKey\t$sHex\t# 0x9b\t3\tSWAP12\t\t".$sArguments."\t\tExchange 1st and 13th stack items\n"; break;
			case 0x9c: print "$iKey\t$sHex\t# 0x9c\t3\tSWAP13\t\t".$sArguments."\t\tExchange 1st and 14th stack items\n"; break;
			case 0x9d: print "$iKey\t$sHex\t# 0x9d\t3\tSWAP14\t\t".$sArguments."\t\tExchange 1st and 15th stack items\n"; break;
			case 0x9e: print "$iKey\t$sHex\t# 0x9e\t3\tSWAP15\t\t".$sArguments."\t\tExchange 1st and 16th stack items\n"; break;
			case 0x9f: print "$iKey\t$sHex\t# 0x9f\t3\tSWAP16\t\t".$sArguments."\t\tExchange 1st and 17th stack items\n"; break;
			case 0xa0: print "$iKey\t$sHex\t# 0xa0\t375\tLOG0\t\t".$sArguments."\t\tAppend log record with no topics\n"; break;
			case 0xa1: print "$iKey\t$sHex\t# 0xa1\t750\tLOG1\t\t".$sArguments."\t\tAppend log record with one topic\n"; break;
			case 0xa2: print "$iKey\t$sHex\t# 0xa2\t1125\tLOG2\t\t".$sArguments."\t\tAppend log record with two topics\n"; break;
			case 0xa3: print "$iKey\t$sHex\t# 0xa3\t1500\tLOG3\t\t".$sArguments."\t\tAppend log record with three topics\n"; break;
			case 0xa4: print "$iKey\t$sHex\t# 0xa4\t1875\tLOG4\t\t".$sArguments."\t\tAppend log record with four topics\n"; break;
			case 0xf0: print "$iKey\t$sHex\t# 0xf0\t32000\tCREATE\t\t".$sArguments."\t\tCreate a new account with associated code\n"; break;
			case 0xf1: print "$iKey\t$sHex\t# 0xf1\t40\tCALL\t\t".$sArguments."\t\tMessage-call into an account\n"; break;
			case 0xf2: print "$iKey\t$sHex\t# 0xf2\t40\tCALLCODE\t\t".$sArguments."\t\tMessage-call into this account with alternative account’s code\n"; break;
			case 0xf3: print "$iKey\t$sHex\t# 0xf3\t0\tRETURN\t\t".$sArguments."\t\tHalt execution returning output data\n"; break;
			case 0xf4: print "$iKey\t$sHex\t# 0xf4\t40\tDELEGATECALL\t\t".$sArguments."\t\tMessage-call into this account with an alternative account’s code, but persisting the current values for sender and value\n"; break;
			case 0xf5: print "$iKey\t$sHex\t# 0x9d\t3\tCREATE2\t\t".$sArguments."\t\tCreate a new account with associated code.\n"; break;
			case 0xfa: print "$iKey\t$sHex\t# 0x9e\t3\tSTATICCALL\t\t".$sArguments."\t\tStatic message-call into an account.\n"; break;
			case 0xfd: print "$iKey\t$sHex\t# 0x9f\t3\tREVERT\t\t".$sArguments."\t\tHalt execution reverting state changes but returning data and remaining gas.\n"; break;
			case 0xfe: print "$iKey\t$sHex\t# 0xff\tNaN\tINVALID\t\t".$sArguments."\t\tDesignated invalid instruction\n"; break;
			case 0xff: print "$iKey\t$sHex\t# 0xff\t0\tSELFDESTRUCT\t\t".$sArguments."\t\tHalt execution and register account for later deletion\n"; break;
			default: print "default: $iKey\t$sHex\t#\n";
		}
*/
		return true;
	}
}

?>