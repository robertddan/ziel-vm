<?php
namespace App\Suiteziel\Vm;


use App\Suiteziel\Vm\Box;

class Opcodes extends Box
{
	
	public $aHex;
	public $aArguments;
	public $aaOpcodes;

	public function __construct () {
		$this->iCursor = 0;
		$this->aaStack = array();
		$this->aArguments = array();
		
		$this->set_opcodes();
	}
	
	public function hex_set ($aHex = null) :bool {
		$this->aHex = $aHex;
		return true;
	}

	public function initiate ($i_k = null, $sHex = null) :bool {  // view
		$i_k = $i_k + 1;
		if (!isset($this->aaOpcodes[$sHex])) { $this->aArguments = array(); return true; }
		$aArguments = array_slice($this->aHex, $i_k, $this->aaOpcodes[$sHex][0]);
		
		
		$this->aArguments = array_map(function($sHex) {
			return pack("H*", $sHex);
		}, $aArguments);
		
		return true;
	}

	public function describe($i_k = null, $sHex = null) :bool {
		$sArguments = implode(",", $this->aArguments);
		if (!isset($this->aaOpcodes[$sHex])) { print "$i_k\t------------- Default:\t\t$sHex\t# ----------- \n"; return true; }
		print "$i_k\t". base_convert($sHex, 10, 16) ."\t#". 
			$this->aaOpcodes[$sHex][2] ."\t". 
			$this->aaOpcodes[$sHex][0] ."\t". 
			$this->aaOpcodes[$sHex][3] ."\t\t". 
			$sArguments ."\t\t". 
			$this->aaOpcodes[$sHex][4] ."\n";
		return true;
	}
	
	public function opcodes ($i_k = null, $sHex = null) {
		switch ($i_k) {
			case 1: return $this->aaOpcodes[$sHex][0]; break; //arguments
			case 1: return $this->aaOpcodes[$sHex][1]; break; //arguments stack (delta)
			case 2: return $this->aaOpcodes[$sHex][2]; break; //price
			case 3: return $this->aaOpcodes[$sHex][3]; break; //hex name
			case 4: return $this->aaOpcodes[$sHex][4]; break; //name
			case 5: return $this->aaOpcodes[$sHex][5]; break; //description
			default: return false;
		}
		return true;
	}

	public function set_opcodes () {
		$this->aaOpcodes = array(
			0x00 => array(0, 0, 0, 0x00, "STOP", "Halts execution"),
			0x01 => array(0, 2, 3, 0x01, "ADD", "Addition operation"),
			0x02 => array(0, 2, 5, 0x02, "MUL", "Multiplication operation"),
			0x03 => array(0, 2, 3, 0x03, "SUB", "Subtraction operation"),
			0x04 => array(0, 2, 5, 0x04, "DIV", "Integer division operation"),
			0x05 => array(0, 2, 5, 0x05, "SDIV", "Signed integer division operation (truncated)"),
			0x06 => array(0, 2, 5, 0x06, "MOD", "Modulo remainder operation"),
			0x07 => array(0, 2, 5, 0x07, "SMOD", "Signed modulo remainder operation"),
			0x08 => array(0, 3, 8, 0x08, "ADDMOD", "Modulo addition operation"),
			0x09 => array(0, 3, 8, 0x09, "MULMOD", "Modulo multiplication operation"),
			0x0a => array(0, 2, 10, 0x0a, "EXP", "Exponential operation"),
			0x0b => array(0, 2, 5, 0x0b, "SIGNEXTEND", "Extend length of two’s complement signed integer"),
			0x10 => array(0, 2, 3, 0x10, "LT", "Less-than comparison"),
			0x11 => array(0, 2, 3, 0x11, "GT", "Greater-than comparison"),
			0x12 => array(0, 2, 3, 0x12, "SLT", "Signed less-than comparison"),
			0x13 => array(0, 2, 3, 0x13, "SGT", "Signed greater-than comparison"),
			0x14 => array(0, 2, 3, 0x14, "EQ", "Equality comparison"),
			0x15 => array(0, 2, 3, 0x15, "ISZERO", "Simple not operator"),
			0x16 => array(0, 2, 3, 0x16, "AND", "Bitwise AND operation"),
			0x17 => array(0, 2, 3, 0x17, "OR", "Bitwise OR operation"),
			0x18 => array(0, 2, 3, 0x18, "XOR", "Bitwise XOR operation"),
			0x19 => array(0, 1, 3, 0x19, "NOT", "Bitwise NOT operation"),
			0x1b => array(0, 2, 3, 0x1b, "SHL", "Left shift operation."),
			0x1c => array(0, 2, 3, 0x1c, "SHR", "Logical right shift operation."),
			0x1d => array(0, 2, 3, 0x1d, "SAR", "Arithmetic (signed) right shift operation."),
			0x1a => array(0, 2, 3, 0x1a, "BYTE", "Retrieve single byte from word"),
			0x20 => array(0, 2, 30, 0x20, "SHA3", "Compute Keccak-256 hash"),
			0x30 => array(0, 0, 2, 0x30, "ADDRESS", "Get address of currently executing account"),
			0x31 => array(0, 1, 20, 0x31, "BALANCE", "Get balance of the given account"),
			0x32 => array(0, 0, 2, 0x32, "ORIGIN", "Get execution origination address"),
			0x33 => array(0, 0, 2, 0x33, "CALLER", "Get caller address"),
			0x34 => array(0, 0, 2, 0x34, "CALLVALUE", "Get deposited value by the instruction/transaction responsible for this execution"),
			0x35 => array(0, 1, 3, 0x35, "CALLDATALOAD", "Get input data of current environment"),
			0x36 => array(0, 0, 2, 0x36, "CALLDATASIZE", "Get size of input data in current environment"),
			0x37 => array(0, 3, 3, 0x37, "CALLDATACOPY", "Copy input data in current environment to memory"),
			0x38 => array(0, 0, 2, 0x38, "CODESIZE", "Get size of code running in current environment"),
			0x39 => array(0, 3, 3, 0x39, "CODECOPY", "Copy code running in current environment to memory"),
			0x3a => array(0, 0, 2, 0x3a, "GASPRICE", "Get price of gas in current environment"),
			0x3b => array(0, 1, 20, 0x3b, "EXTCODESIZE", "Get size of an account’s code"),
			0x3c => array(0, 4, 20, 0x3c, "EXTCODECOPY", "Copy an account’s code to memory"),
			0x40 => array(0, 0, 20, 0x40, "BLOCKHASH", "Get the hash of one of the 256 most recent complete blocks"),
			0x41 => array(0, 0, 2, 0x41, "COINBASE", "Get the block’s beneficiary address"),
			0x42 => array(0, 0, 2, 0x42, "TIMESTAMP", "Get the block’s timestamp"),
			0x43 => array(0, 0, 2, 0x43, "NUMBER", "Get the block’s number"),
			0x44 => array(0, 0, 2, 0x44, "DIFFICULTY", "Get the block’s difficulty"),
			0x45 => array(0, 0, 2, 0x45, "GASLIMIT", "Get the block’s gas limit"),
			0x50 => array(0, 0, 2, 0x50, "POP", "Remove item from stack"),
			0x51 => array(0, 0, 3, 0x51, "MLOAD", "Load word from memory"),
			0x52 => array(0, 0, 3, 0x52, "MSTORE", "Save word to memory"),
			0x53 => array(0, 0, 3, 0x53, "MSTORE8", "Save byte to memory"),
			0x54 => array(0, 0, 50, 0x54, "SLOAD", "Load word from storage"),
			0x55 => array(0, 0, 5000, 0x55, "SSTORE", "Save word to storage"),
			0x56 => array(0, 0, 8, 0x56, "JUMP", "Alter the program counter"),
			0x57 => array(0, 0, 10, 0x57, "JUMPI", "Conditionally alter the program counter"),
			0x58 => array(0, 0, 2, 0x58, "PC", "Get the value of the program counter prior to the increment corresponding to this instruction"),
			0x59 => array(0, 0, 2, 0x59, "MSIZE", "Get the size of active memory in bytes"),
			0x5a => array(0, 0, 2, 0x5a, "GAS", "Get the amount of available gas, including the corresponding reduction for the cost of this instruction"),
			0x5b => array(0, 0, 1, 0x5b, "JUMPDEST", "Mark a valid destination for jumps"),
			0x60 => array(1, 0, 3, 0x60, "PUSH1", "Place 1 byte item on stack"),
			0x61 => array(1, 0, 3, 0x61, "PUSH2", "Place 2 byte item on stack"),
			0x62 => array(1, 0, 3, 0x62, "PUSH3", "Place 3 byte item on stack"),
			0x63 => array(1, 0, 3, 0x63, "PUSH4", "Place 4 byte item on stack"),
			0x64 => array(1, 0, 3, 0x64, "PUSH5", "Place 5 byte item on stack"),
			0x65 => array(1, 0, 3, 0x65, "PUSH6", "Place 6 byte item on stack"),
			0x66 => array(1, 0, 3, 0x66, "PUSH7", "Place 7 byte item on stack"),
			0x67 => array(1, 0, 3, 0x67, "PUSH8", "Place 8 byte item on stack"),
			0x68 => array(1, 0, 3, 0x68, "PUSH9", "Place 9 byte item on stack"),
			0x69 => array(1, 0, 3, 0x69, "PUSH10", "Place 10 byte item on stack"),
			0x6a => array(1, 0, 3, 0x6a, "PUSH11", "Place 11 byte item on stack"),
			0x6b => array(1, 0, 3, 0x6b, "PUSH12", "Place 12 byte item on stack"),
			0x6c => array(1, 0, 3, 0x6c, "PUSH13", "Place 13 byte item on stack"),
			0x6d => array(1, 0, 3, 0x6d, "PUSH14", "Place 14 byte item on stack"),
			0x6e => array(1, 0, 3, 0x6e, "PUSH15", "Place 15 byte item on stack"),
			0x6f => array(1, 0, 3, 0x6f, "PUSH16", "Place 16 byte item on stack"),
			0x70 => array(1, 0, 3, 0x70, "PUSH17", "Place 17 byte item on stack"),
			0x71 => array(1, 0, 3, 0x71, "PUSH18", "Place 18 byte item on stack"),
			0x72 => array(1, 0, 3, 0x72, "PUSH19", "Place 19 byte item on stack"),
			0x73 => array(1, 0, 3, 0x73, "PUSH20", "Place 20 byte item on stack"),
			0x74 => array(1, 0, 3, 0x74, "PUSH21", "Place 21 byte item on stack"),
			0x75 => array(1, 0, 3, 0x75, "PUSH22", "Place 22 byte item on stack"),
			0x76 => array(1, 0, 3, 0x76, "PUSH23", "Place 23 byte item on stack"),
			0x77 => array(1, 0, 3, 0x77, "PUSH24", "Place 24 byte item on stack"),
			0x78 => array(1, 0, 3, 0x78, "PUSH25", "Place 25 byte item on stack"),
			0x79 => array(1, 0, 3, 0x79, "PUSH26", "Place 26 byte item on stack"),
			0x7a => array(1, 0, 3, 0x7a, "PUSH27", "Place 27 byte item on stack"),
			0x7b => array(1, 0, 3, 0x7b, "PUSH28", "Place 28 byte item on stack"),
			0x7c => array(1, 0, 3, 0x7c, "PUSH29", "Place 29 byte item on stack"),
			0x7d => array(1, 0, 3, 0x7d, "PUSH30", "Place 30 byte item on stack"),
			0x7e => array(1, 0, 3, 0x7e, "PUSH31", "Place 31 byte item on stack"),
			0x7f => array(1, 0, 3, 0x7f, "PUSH32", "Place 32 byte (full word) item on stack"),
			0x80 => array(0, 1, 3, 0x80, "DUP1", "Duplicate 1st stack item"),
			0x81 => array(0, 2, 3, 0x81, "DUP2", "Duplicate 2nd stack item"),
			0x82 => array(0, 3, 3, 0x82, "DUP3", "Duplicate 3rd stack item"),
			0x83 => array(0, 4, 3, 0x83, "DUP4", "Duplicate 4th stack item"),
			0x84 => array(0, 5, 3, 0x84, "DUP5", "Duplicate 5th stack item"),
			0x85 => array(0, 6, 3, 0x85, "DUP6", "Duplicate 6th stack item"),
			0x86 => array(0, 7, 3, 0x86, "DUP7", "Duplicate 7th stack item"),
			0x87 => array(0, 8, 3, 0x87, "DUP8", "Duplicate 8th stack item"),
			0x88 => array(0, 9, 3, 0x88, "DUP9", "Duplicate 9th stack item"),
			0x89 => array(0, 10, 3, 0x89, "DUP10", "Duplicate 10th stack item"),
			0x8a => array(0, 11, 3, 0x8a, "DUP11", "Duplicate 11th stack item"),
			0x8b => array(0, 12, 3, 0x8b, "DUP12", "Duplicate 12th stack item"),
			0x8c => array(0, 13, 3, 0x8c, "DUP13", "Duplicate 13th stack item"),
			0x8d => array(0, 14, 3, 0x8d, "DUP14", "Duplicate 14th stack item"),
			0x8e => array(0, 15, 3, 0x8e, "DUP15", "Duplicate 15th stack item"),
			0x8f => array(0, 16, 3, 0x8f, "DUP16", "Duplicate 16th stack item"),
			0x90 => array(0, 2, 3, 0x90, "SWAP1", "Exchange 1st and 2nd stack items"),
			0x91 => array(0, 3, 3, 0x91, "SWAP2", "Exchange 1st and 3rd stack items"),
			0x92 => array(0, 4, 3, 0x92, "SWAP3", "Exchange 1st and 4th stack items"),
			0x93 => array(0, 5, 3, 0x93, "SWAP4", "Exchange 1st and 5th stack items"),
			0x94 => array(0, 6, 3, 0x94, "SWAP5", "Exchange 1st and 6th stack items"),
			0x95 => array(0, 7, 3, 0x95, "SWAP6", "Exchange 1st and 7th stack items"),
			0x96 => array(0, 8, 3, 0x96, "SWAP7", "Exchange 1st and 8th stack items"),
			0x97 => array(0, 9, 3, 0x97, "SWAP8", "Exchange 1st and 9th stack items"),
			0x98 => array(0, 10, 3, 0x98, "SWAP9", "Exchange 1st and 10th stack items"),
			0x99 => array(0, 11, 3, 0x99, "SWAP10", "Exchange 1st and 11th stack items"),
			0x9a => array(0, 12, 3, 0x9a, "SWAP11", "Exchange 1st and 12th stack items"),
			0x9b => array(0, 13, 3, 0x9b, "SWAP12", "Exchange 1st and 13th stack items"),
			0x9c => array(0, 14, 3, 0x9c, "SWAP13", "Exchange 1st and 14th stack items"),
			0x9d => array(0, 15, 3, 0x9d, "SWAP14", "Exchange 1st and 15th stack items"),
			0x9e => array(0, 16, 3, 0x9e, "SWAP15", "Exchange 1st and 16th stack items"),
			0x9f => array(0, 17, 3, 0x9f, "SWAP16", "Exchange 1st and 17th stack items"),
			0xa0 => array(0, 0, 375, 0xa0, "LOG0", "Append log record with no topics"),
			0xa1 => array(0, 0, 750, 0xa1, "LOG1", "Append log record with one topic"),
			0xa2 => array(0, 0, 1125, 0xa2, "LOG2", "Append log record with two topics"),
			0xa3 => array(0, 0, 1500, 0xa3, "LOG3", "Append log record with three topics"),
			0xa4 => array(0, 0, 1875, 0xa4, "LOG4", "Append log record with four topics"),
			0xf0 => array(0, 0, 32000, 0xf0, "CREATE", "Create a new account with associated code"),
			0xf1 => array(0, 0, 40, 0xf1, "CALL", "Message-call into an account"),
			0xf2 => array(0, 0, 40, 0xf2, "CALLCODE", "Message-call into this account with alternative account’s code"),
			0xf3 => array(0, 0, 0, 0xf3, "RETURN", "Halt execution returning output data"),
			0xf4 => array(0, 0, 40, 0xf4, "DELEGATECALL", "Message-call into this account with an alternative account’s code, but persisting the current values for sender and value"),
			0xf5 => array(0, 0, 0, 0xf5, "CREATE2", "Create a new account with associated code."),
			0xfa => array(0, 0, 0, 0xfa, "STATICCALL", "Static message-call into an account."),
			0xfd => array(0, 0, 0, 0xfd, "REVERT", "Halt execution reverting state changes but returning data and remaining gas."),
			0xfe => array(0, 0, 40, 0xfe, "INVALIDL", "Designated invalid instruction"),
			0xff => array(0, 0, 0, 0xff, "SELFDESTRUCT", "Halt execution and register account for later deletion"),
		);
	}
}

?>