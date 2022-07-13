<?php
namespace App\Suiteziel\Vm;


class Opcodes
{
	public $iCursor;
		
	public function __construct () {
		$this->iCursor = 0;
	}

	public function describe($iKey = null, $aArguments = null) {
		$sArguments = implode(",", $aArguments);
		switch ($iKey) {
			case 0x00: return "0x00\t0\tSTOP\t\t".$sArguments."\t\tHalts execution\n"; break;
			case 0x01: return "0x01\t3\tADD\t\t".$sArguments."\t\tAddition operation\n"; break;
			case 0x02: return "0x02\t5\tMUL\t\t".$sArguments."\t\tMultiplication operation\n"; break;
			case 0x03: return "0x03\t3\tSUB\t\t".$sArguments."\t\tSubtraction operation\n"; break;
			case 0x04: return "0x04\t5\tDIV\t\t".$sArguments."\t\tInteger division operation\n"; break;
			case 0x05: return "0x05\t5\tSDIV\t\t".$sArguments."\t\tSigned integer division operation (truncated)\n"; break;
			case 0x06: return "0x06\t5\tMOD\t\t".$sArguments."\t\tModulo remainder operation\n"; break;
			case 0x07: return "0x07\t5\tSMOD\t\t".$sArguments."\t\tSigned modulo remainder operation\n"; break;
			case 0x08: return "0x08\t8\tADDMOD\t\t".$sArguments."\t\tModulo addition operation\n"; break;
			case 0x09: return "0x09\t8\tMULMOD\t\t".$sArguments."\t\tModulo multiplication operation\n"; break;
			case 0x0a: return "0x0a\t10\tEXP\t\t".$sArguments."\t\tExponential operation\n"; break;
			case 0x0b: return "0x0b\t5\tSIGNEXTEND\t\t".$sArguments."\t\tExtend length of two’s complement signed integer\n"; break;
			case 0x10: return "0x10\t3\tLT\t\t".$sArguments."\t\tLess-than comparison\n"; break;
			case 0x11: return "0x11\t3\tGT\t\t".$sArguments."\t\tGreater-than comparison\n"; break;
			case 0x12: return "0x12\t3\tSLT\t\t".$sArguments."\t\tSigned less-than comparison\n"; break;
			case 0x13: return "0x13\t3\tSGT\t\t".$sArguments."\t\tSigned greater-than comparison\n"; break;
			case 0x14: return "0x14\t3\tEQ\t\t".$sArguments."\t\tEquality comparison\n"; break;
			case 0x15: return "0x15\t3\tISZERO\t\t".$sArguments."\t\tSimple not operator\n"; break;
			case 0x16: return "0x16\t3\tAND\t\t".$sArguments."\t\tBitwise AND operation\n"; break;
			case 0x17: return "0x17\t3\tOR\t\t".$sArguments."\t\tBitwise OR operation\n"; break;
			case 0x18: return "0x18\t3\tXOR\t\t".$sArguments."\t\tBitwise XOR operation\n"; break;
			case 0x19: return "0x19\t3\tNOT\t\t".$sArguments."\t\tBitwise NOT operation\n"; break;
			case 0x1a: return "0x1a\t3\tBYTE\t\t".$sArguments."\t\tRetrieve single byte from word\n"; break;
			case 0x20: return "0x20\t30\tSHA3\t\t".$sArguments."\t\tCompute Keccak-256 hash\n"; break;
			case 0x30: return "0x30\t2\tADDRESS\t\t".$sArguments."\t\tGet address of currently executing account\n"; break;
			case 0x31: return "0x31\t20\tBALANCE\t\t".$sArguments."\t\tGet balance of the given account\n"; break;
			case 0x32: return "0x32\t2\tORIGIN\t\t".$sArguments."\t\tGet execution origination address\n"; break;
			case 0x33: return "0x33\t2\tCALLER\t\t".$sArguments."\t\tGet caller address\n"; break;
			case 0x34: return "0x34\t2\tCALLVALUE\t\t".$sArguments."\t\tGet deposited value by the instruction/transaction responsible for this execution\n"; break;
			case 0x35: return "0x35\t3\tCALLDATALOAD\t\t".$sArguments."\t\tGet input data of current environment\n"; break;
			case 0x36: return "0x36\t2\tCALLDATASIZE\t\t".$sArguments."\t\tGet size of input data in current environment\n"; break;
			case 0x37: return "0x37\t3\tCALLDATACOPY\t\t".$sArguments."\t\tCopy input data in current environment to memory\n"; break;
			case 0x38: return "0x38\t2\tCODESIZE\t\t".$sArguments."\t\tGet size of code running in current environment\n"; break;
			case 0x39: return "0x39\t3\tCODECOPY\t\t".$sArguments."\t\tCopy code running in current environment to memory\n"; break;
			case 0x3a: return "0x3a\t2\tGASPRICE\t\t".$sArguments."\t\tGet price of gas in current environment\n"; break;
			case 0x3b: return "0x3b\t20\tEXTCODESIZE\t\t".$sArguments."\t\tGet size of an account’s code\n"; break;
			case 0x3c: return "0x3c\t20\tEXTCODECOPY\t\t".$sArguments."\t\tCopy an account’s code to memory\n"; break;
			case 0x40: return "0x40\t20\tBLOCKHASH\t\t".$sArguments."\t\tGet the hash of one of the 256 most recent complete blocks\n"; break;
			case 0x41: return "0x41\t2\tCOINBASE\t\t".$sArguments."\t\tGet the block’s beneficiary address\n"; break;
			case 0x42: return "0x42\t2\tTIMESTAMP\t\t".$sArguments."\t\tGet the block’s timestamp\n"; break;
			case 0x43: return "0x43\t2\tNUMBER\t\t".$sArguments."\t\tGet the block’s number\n"; break;
			case 0x44: return "0x44\t2\tDIFFICULTY\t\t".$sArguments."\t\tGet the block’s difficulty\n"; break;
			case 0x45: return "0x45\t2\tGASLIMIT\t\t".$sArguments."\t\tGet the block’s gas limit\n"; break;
			case 0x50: return "0x50\t2\tPOP\t\t".$sArguments."\t\tRemove item from stack\n"; break;
			case 0x51: return "0x51\t3\tMLOAD\t\t".$sArguments."\t\tLoad word from memory\n"; break;
			case 0x52: return "0x52\t3\tMSTORE\t\t".$sArguments."\t\tSave word to memory\n"; break;
			case 0x53: return "0x53\t3\tMSTORE8\t\t".$sArguments."\t\tSave byte to memory\n"; break;
			case 0x54: return "0x54\t50\tSLOAD\t\t".$sArguments."\t\tLoad word from storage\n"; break;
			case 0x55: return "0x55\t5000\tSSTORE\t\t".$sArguments."\t\tSave word to storage\n"; break;
			case 0x56: return "0x56\t8\tJUMP\t\t".$sArguments."\t\tAlter the program counter\n"; break;
			case 0x57: return "0x57\t10\tJUMPI\t\t".$sArguments."\t\tConditionally alter the program counter\n"; break;
			case 0x58: return "0x58\t2\tPC\t\t".$sArguments."\t\tGet the value of the program counter prior to the increment corresponding to this instruction\n"; break;
			case 0x59: return "0x59\t2\tMSIZE\t\t".$sArguments."\t\tGet the size of active memory in bytes\n"; break;
			case 0x5a: return "0x5a\t2\tGAS\t\t".$sArguments."\t\tGet the amount of available gas, including the corresponding reduction for the cost of this instruction\n"; break;
			case 0x5b: return "0x5b\t1\tJUMPDEST\t\t".$sArguments."\t\tMark a valid destination for jumps\n"; break;
			case 0x60: return "0x60\t3\tPUSH1\t\t".$sArguments."\t\tPlace 1 byte item on stack\n"; break;
			case 0x61: return "0x61\t3\tPUSH2\t\t".$sArguments."\t\tPlace 2 byte item on stack\n"; break;
			case 0x62: return "0x62\t3\tPUSH3\t\t".$sArguments."\t\tPlace 3 byte item on stack\n"; break;
			case 0x63: return "0x63\t3\tPUSH4\t\t".$sArguments."\t\tPlace 4 byte item on stack\n"; break;
			case 0x64: return "0x64\t3\tPUSH5\t\t".$sArguments."\t\tPlace 5 byte item on stack\n"; break;
			case 0x65: return "0x65\t3\tPUSH6\t\t".$sArguments."\t\tPlace 6 byte item on stack\n"; break;
			case 0x66: return "0x66\t3\tPUSH7\t\t".$sArguments."\t\tPlace 7 byte item on stack\n"; break;
			case 0x67: return "0x67\t3\tPUSH8\t\t".$sArguments."\t\tPlace 8 byte item on stack\n"; break;
			case 0x68: return "0x68\t3\tPUSH9\t\t".$sArguments."\t\tPlace 9 byte item on stack\n"; break;
			case 0x69: return "0x69\t3\tPUSH10\t\t".$sArguments."\t\tPlace 10 byte item on stack\n"; break;
			case 0x6a: return "0x6a\t3\tPUSH11\t\t".$sArguments."\t\tPlace 11 byte item on stack\n"; break;
			case 0x6b: return "0x6b\t3\tPUSH12\t\t".$sArguments."\t\tPlace 12 byte item on stack\n"; break;
			case 0x6c: return "0x6c\t3\tPUSH13\t\t".$sArguments."\t\tPlace 13 byte item on stack\n"; break;
			case 0x6d: return "0x6d\t3\tPUSH14\t\t".$sArguments."\t\tPlace 14 byte item on stack\n"; break;
			case 0x6e: return "0x6e\t3\tPUSH15\t\t".$sArguments."\t\tPlace 15 byte item on stack\n"; break;
			case 0x6f: return "0x6f\t3\tPUSH16\t\t".$sArguments."\t\tPlace 16 byte item on stack\n"; break;
			case 0x70: return "0x70\t3\tPUSH17\t\t".$sArguments."\t\tPlace 17 byte item on stack\n"; break;
			case 0x71: return "0x71\t3\tPUSH18\t\t".$sArguments."\t\tPlace 18 byte item on stack\n"; break;
			case 0x72: return "0x72\t3\tPUSH19\t\t".$sArguments."\t\tPlace 19 byte item on stack\n"; break;
			case 0x73: return "0x73\t3\tPUSH20\t\t".$sArguments."\t\tPlace 20 byte item on stack\n"; break;
			case 0x74: return "0x74\t3\tPUSH21\t\t".$sArguments."\t\tPlace 21 byte item on stack\n"; break;
			case 0x75: return "0x75\t3\tPUSH22\t\t".$sArguments."\t\tPlace 22 byte item on stack\n"; break;
			case 0x76: return "0x76\t3\tPUSH23\t\t".$sArguments."\t\tPlace 23 byte item on stack\n"; break;
			case 0x77: return "0x77\t3\tPUSH24\t\t".$sArguments."\t\tPlace 24 byte item on stack\n"; break;
			case 0x78: return "0x78\t3\tPUSH25\t\t".$sArguments."\t\tPlace 25 byte item on stack\n"; break;
			case 0x79: return "0x79\t3\tPUSH26\t\t".$sArguments."\t\tPlace 26 byte item on stack\n"; break;
			case 0x7a: return "0x7a\t3\tPUSH27\t\t".$sArguments."\t\tPlace 27 byte item on stack\n"; break;
			case 0x7b: return "0x7b\t3\tPUSH28\t\t".$sArguments."\t\tPlace 28 byte item on stack\n"; break;
			case 0x7c: return "0x7c\t3\tPUSH29\t\t".$sArguments."\t\tPlace 29 byte item on stack\n"; break;
			case 0x7d: return "0x7d\t3\tPUSH30\t\t".$sArguments."\t\tPlace 30 byte item on stack\n"; break;
			case 0x7e: return "0x7e\t3\tPUSH31\t\t".$sArguments."\t\tPlace 31 byte item on stack\n"; break;
			case 0x7f: return "0x7f\t3\tPUSH32\t\t".$sArguments."\t\tPlace 32 byte (full word) item on stack\n"; break;
			case 0x80: return "0x80\t3\tDUP1\t\t".$sArguments."\t\tDuplicate 1st stack item\n"; break;
			case 0x81: return "0x81\t3\tDUP2\t\t".$sArguments."\t\tDuplicate 2nd stack item\n"; break;
			case 0x82: return "0x82\t3\tDUP3\t\t".$sArguments."\t\tDuplicate 3rd stack item\n"; break;
			case 0x83: return "0x83\t3\tDUP4\t\t".$sArguments."\t\tDuplicate 4th stack item\n"; break;
			case 0x84: return "0x84\t3\tDUP5\t\t".$sArguments."\t\tDuplicate 5th stack item\n"; break;
			case 0x85: return "0x85\t3\tDUP6\t\t".$sArguments."\t\tDuplicate 6th stack item\n"; break;
			case 0x86: return "0x86\t3\tDUP7\t\t".$sArguments."\t\tDuplicate 7th stack item\n"; break;
			case 0x87: return "0x87\t3\tDUP8\t\t".$sArguments."\t\tDuplicate 8th stack item\n"; break;
			case 0x88: return "0x88\t3\tDUP9\t\t".$sArguments."\t\tDuplicate 9th stack item\n"; break;
			case 0x89: return "0x89\t3\tDUP10\t\t".$sArguments."\t\tDuplicate 10th stack item\n"; break;
			case 0x8a: return "0x8a\t3\tDUP11\t\t".$sArguments."\t\tDuplicate 11th stack item\n"; break;
			case 0x8b: return "0x8b\t3\tDUP12\t\t".$sArguments."\t\tDuplicate 12th stack item\n"; break;
			case 0x8c: return "0x8c\t3\tDUP13\t\t".$sArguments."\t\tDuplicate 13th stack item\n"; break;
			case 0x8d: return "0x8d\t3\tDUP14\t\t".$sArguments."\t\tDuplicate 14th stack item\n"; break;
			case 0x8e: return "0x8e\t3\tDUP15\t\t".$sArguments."\t\tDuplicate 15th stack item\n"; break;
			case 0x8f: return "0x8f\t3\tDUP16\t\t".$sArguments."\t\tDuplicate 16th stack item\n"; break;
			case 0x90: return "0x90\t3\tSWAP1\t\t".$sArguments."\t\tExchange 1st and 2nd stack items\n"; break;
			case 0x91: return "0x91\t3\tSWAP2\t\t".$sArguments."\t\tExchange 1st and 3rd stack items\n"; break;
			case 0x92: return "0x92\t3\tSWAP3\t\t".$sArguments."\t\tExchange 1st and 4th stack items\n"; break;
			case 0x93: return "0x93\t3\tSWAP4\t\t".$sArguments."\t\tExchange 1st and 5th stack items\n"; break;
			case 0x94: return "0x94\t3\tSWAP5\t\t".$sArguments."\t\tExchange 1st and 6th stack items\n"; break;
			case 0x95: return "0x95\t3\tSWAP6\t\t".$sArguments."\t\tExchange 1st and 7th stack items\n"; break;
			case 0x96: return "0x96\t3\tSWAP7\t\t".$sArguments."\t\tExchange 1st and 8th stack items\n"; break;
			case 0x97: return "0x97\t3\tSWAP8\t\t".$sArguments."\t\tExchange 1st and 9th stack items\n"; break;
			case 0x98: return "0x98\t3\tSWAP9\t\t".$sArguments."\t\tExchange 1st and 10th stack items\n"; break;
			case 0x99: return "0x99\t3\tSWAP10\t\t".$sArguments."\t\tExchange 1st and 11th stack items\n"; break;
			case 0x9a: return "0x9a\t3\tSWAP11\t\t".$sArguments."\t\tExchange 1st and 12th stack items\n"; break;
			case 0x9b: return "0x9b\t3\tSWAP12\t\t".$sArguments."\t\tExchange 1st and 13th stack items\n"; break;
			case 0x9c: return "0x9c\t3\tSWAP13\t\t".$sArguments."\t\tExchange 1st and 14th stack items\n"; break;
			case 0x9d: return "0x9d\t3\tSWAP14\t\t".$sArguments."\t\tExchange 1st and 15th stack items\n"; break;
			case 0x9e: return "0x9e\t3\tSWAP15\t\t".$sArguments."\t\tExchange 1st and 16th stack items\n"; break;
			case 0x9f: return "0x9f\t3\tSWAP16\t\t".$sArguments."\t\tExchange 1st and 17th stack items\n"; break;
			case 0xa0: return "0xa0\t375\tLOG0\t\t".$sArguments."\t\tAppend log record with no topics\n"; break;
			case 0xa1: return "0xa1\t750\tLOG1\t\t".$sArguments."\t\tAppend log record with one topic\n"; break;
			case 0xa2: return "0xa2\t1125\tLOG2\t\t".$sArguments."\t\tAppend log record with two topics\n"; break;
			case 0xa3: return "0xa3\t1500\tLOG3\t\t".$sArguments."\t\tAppend log record with three topics\n"; break;
			case 0xa4: return "0xa4\t1875\tLOG4\t\t".$sArguments."\t\tAppend log record with four topics\n"; break;
			case 0xf0: return "0xf0\t32000\tCREATE\t\t".$sArguments."\t\tCreate a new account with associated code\n"; break;
			case 0xf1: return "0xf1\t40\tCALL\t\t".$sArguments."\t\tMessage-call into an account\n"; break;
			case 0xf2: return "0xf2\t40\tCALLCODE\t\t".$sArguments."\t\tMessage-call into this account with alternative account’s code\n"; break;
			case 0xf3: return "0xf3\t0\tRETURN\t\t".$sArguments."\t\tHalt execution returning output data\n"; break;
			case 0xf4: return "0xf4\t40\tDELEGATECALL\t\t".$sArguments."\t\tMessage-call into this account with an alternative account’s code, but persisting the current values for sender and value\n"; break;
			case 0xfe: return "0xff\tNaN\tINVALID\t\t".$sArguments."\t\tDesignated invalid instruction\n"; break;
			case 0xff: return "0xff\t0\tSELFDESTRUCT\t\t".$sArguments."\t\tHalt execution and register account for later deletion\n"; break;
			default: return "default: $iKey\n";
		}
	}
}

?>