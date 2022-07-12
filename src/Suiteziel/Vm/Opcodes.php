<?php
namespace App\Suiteziel\Vm;


class Opcodes
{
	public function test($iKey = null) {
		
		switch ($iKey) {
case 0x00: echo "0x00\t0\t\tSTOP\tHalts execution\n"; break;
case 0x01: echo "0x01\t3\t\tADD\tAddition operation\n"; break;
case 0x02: echo "0x02\t5\t\tMUL\tMultiplication operation\n"; break;
case 0x03: echo "0x03\t3\t\tSUB\tSubtraction operation\n"; break;
case 0x04: echo "0x04\t5\t\tDIV\tInteger division operation\n"; break;
case 0x05: echo "0x05\t5\t\tSDIV\tSigned integer division operation (truncated)\n"; break;
case 0x06: echo "0x06\t5\t\tMOD\tModulo remainder operation\n"; break;
case 0x07: echo "0x07\t5\t\tSMOD\tSigned modulo remainder operation\n"; break;
case 0x08: echo "0x08\t8\t\tADDMOD\tModulo addition operation\n"; break;
case 0x09: echo "0x09\t8\t\tMULMOD\tModulo multiplication operation\n"; break;
case 0x0a: echo "0x0a\t10\t\tEXP\tExponential operation\n"; break;
case 0x0b: echo "0x0b\t5\t\tSIGNEXTEND\tExtend length of two’s complement signed integer\n"; break;
case 0x10: echo "0x10\t3\t\tLT\tLess-than comparison\n"; break;
case 0x11: echo "0x11\t3\t\tGT\tGreater-than comparison\n"; break;
case 0x12: echo "0x12\t3\t\tSLT\tSigned less-than comparison\n"; break;
case 0x13: echo "0x13\t3\t\tSGT\tSigned greater-than comparison\n"; break;
case 0x14: echo "0x14\t3\t\tEQ\tEquality comparison\n"; break;
case 0x15: echo "0x15\t3\t\tISZERO\tSimple not operator\n"; break;
case 0x16: echo "0x16\t3\t\tAND\tBitwise AND operation\n"; break;
case 0x17: echo "0x17\t3\t\tOR\tBitwise OR operation\n"; break;
case 0x18: echo "0x18\t3\t\tXOR\tBitwise XOR operation\n"; break;
case 0x19: echo "0x19\t3\t\tNOT\tBitwise NOT operation\n"; break;
case 0x1a: echo "0x1a\t3\t\tBYTE\tRetrieve single byte from word\n"; break;
case 0x20: echo "0x20\t30\t\tSHA3\tCompute Keccak-256 hash\n"; break;
case 0x30: echo "0x30\t2\t\tADDRESS\tGet address of currently executing account\n"; break;
case 0x31: echo "0x31\t20\t\tBALANCE\tGet balance of the given account\n"; break;
case 0x32: echo "0x32\t2\t\tORIGIN\tGet execution origination address\n"; break;
case 0x33: echo "0x33\t2\t\tCALLER\tGet caller address\n"; break;
case 0x34: echo "0x34\t2\t\tCALLVALUE\tGet deposited value by the instruction/transaction responsible for this execution\n"; break;
case 0x35: echo "0x35\t3\t\tCALLDATALOAD\tGet input data of current environment\n"; break;
case 0x36: echo "0x36\t2\t\tCALLDATASIZE\tGet size of input data in current environment\n"; break;
case 0x37: echo "0x37\t3\t\tCALLDATACOPY\tCopy input data in current environment to memory\n"; break;
case 0x38: echo "0x38\t2\t\tCODESIZE\tGet size of code running in current environment\n"; break;
case 0x39: echo "0x39\t3\t\tCODECOPY\tCopy code running in current environment to memory\n"; break;
case 0x3a: echo "0x3a\t2\t\tGASPRICE\tGet price of gas in current environment\n"; break;
case 0x3b: echo "0x3b\t20\t\tEXTCODESIZE\tGet size of an account’s code\n"; break;
case 0x3c: echo "0x3c\t20\t\tEXTCODECOPY\tCopy an account’s code to memory\n"; break;
case 0x40: echo "0x40\t20\t\tBLOCKHASH\tGet the hash of one of the 256 most recent complete blocks\n"; break;
case 0x41: echo "0x41\t2\t\tCOINBASE\tGet the block’s beneficiary address\n"; break;
case 0x42: echo "0x42\t2\t\tTIMESTAMP\tGet the block’s timestamp\n"; break;
case 0x43: echo "0x43\t2\t\tNUMBER\tGet the block’s number\n"; break;
case 0x44: echo "0x44\t2\t\tDIFFICULTY\tGet the block’s difficulty\n"; break;
case 0x45: echo "0x45\t2\t\tGASLIMIT\tGet the block’s gas limit\n"; break;
case 0x50: echo "0x50\t2\t\tPOP\tRemove item from stack\n"; break;
case 0x51: echo "0x51\t3\t\tMLOAD\tLoad word from memory\n"; break;
case 0x52: echo "0x52\t3\t\tMSTORE\tSave word to memory\n"; break;
case 0x53: echo "0x53\t3\t\tMSTORE8\tSave byte to memory\n"; break;
case 0x54: echo "0x54\t50\t\tSLOAD\tLoad word from storage\n"; break;
case 0x55: echo "0x55\t5000\t\tSSTORE\tSave word to storage\n"; break;
case 0x56: echo "0x56\t8\t\tJUMP\tAlter the program counter\n"; break;
case 0x57: echo "0x57\t10\t\tJUMPI\tConditionally alter the program counter\n"; break;
case 0x58: echo "0x58\t2\t\tPC\tGet the value of the program counter prior to the increment corresponding to this instruction\n"; break;
case 0x59: echo "0x59\t2\t\tMSIZE\tGet the size of active memory in bytes\n"; break;
case 0x5a: echo "0x5a\t2\t\tGAS\tGet the amount of available gas, including the corresponding reduction for the cost of this instruction\n"; break;
case 0x5b: echo "0x5b\t1\t\tJUMPDEST\tMark a valid destination for jumps\n"; break;
case 0x60: echo "0x60\t3\t\tPUSH1\tPlace 1 byte item on stack\n"; break;
case 0x61: echo "0x61\t3\t\tPUSH2\tPlace 2 byte item on stack\n"; break;
case 0x62: echo "0x62\t3\t\tPUSH3\tPlace 3 byte item on stack\n"; break;
case 0x63: echo "0x63\t3\t\tPUSH4\tPlace 4 byte item on stack\n"; break;
case 0x64: echo "0x64\t3\t\tPUSH5\tPlace 5 byte item on stack\n"; break;
case 0x65: echo "0x65\t3\t\tPUSH6\tPlace 6 byte item on stack\n"; break;
case 0x66: echo "0x66\t3\t\tPUSH7\tPlace 7 byte item on stack\n"; break;
case 0x67: echo "0x67\t3\t\tPUSH8\tPlace 8 byte item on stack\n"; break;
case 0x68: echo "0x68\t3\t\tPUSH9\tPlace 9 byte item on stack\n"; break;
case 0x69: echo "0x69\t3\t\tPUSH10\tPlace 10 byte item on stack\n"; break;
case 0x6a: echo "0x6a\t3\t\tPUSH11\tPlace 11 byte item on stack\n"; break;
case 0x6b: echo "0x6b\t3\t\tPUSH12\tPlace 12 byte item on stack\n"; break;
case 0x6c: echo "0x6c\t3\t\tPUSH13\tPlace 13 byte item on stack\n"; break;
case 0x6d: echo "0x6d\t3\t\tPUSH14\tPlace 14 byte item on stack\n"; break;
case 0x6e: echo "0x6e\t3\t\tPUSH15\tPlace 15 byte item on stack\n"; break;
case 0x6f: echo "0x6f\t3\t\tPUSH16\tPlace 16 byte item on stack\n"; break;
case 0x70: echo "0x70\t3\t\tPUSH17\tPlace 17 byte item on stack\n"; break;
case 0x71: echo "0x71\t3\t\tPUSH18\tPlace 18 byte item on stack\n"; break;
case 0x72: echo "0x72\t3\t\tPUSH19\tPlace 19 byte item on stack\n"; break;
case 0x73: echo "0x73\t3\t\tPUSH20\tPlace 20 byte item on stack\n"; break;
case 0x74: echo "0x74\t3\t\tPUSH21\tPlace 21 byte item on stack\n"; break;
case 0x75: echo "0x75\t3\t\tPUSH22\tPlace 22 byte item on stack\n"; break;
case 0x76: echo "0x76\t3\t\tPUSH23\tPlace 23 byte item on stack\n"; break;
case 0x77: echo "0x77\t3\t\tPUSH24\tPlace 24 byte item on stack\n"; break;
case 0x78: echo "0x78\t3\t\tPUSH25\tPlace 25 byte item on stack\n"; break;
case 0x79: echo "0x79\t3\t\tPUSH26\tPlace 26 byte item on stack\n"; break;
case 0x7a: echo "0x7a\t3\t\tPUSH27\tPlace 27 byte item on stack\n"; break;
case 0x7b: echo "0x7b\t3\t\tPUSH28\tPlace 28 byte item on stack\n"; break;
case 0x7c: echo "0x7c\t3\t\tPUSH29\tPlace 29 byte item on stack\n"; break;
case 0x7d: echo "0x7d\t3\t\tPUSH30\tPlace 30 byte item on stack\n"; break;
case 0x7e: echo "0x7e\t3\t\tPUSH31\tPlace 31 byte item on stack\n"; break;
case 0x7f: echo "0x7f\t3\t\tPUSH32\tPlace 32 byte (full word) item on stack\n"; break;
case 0x80: echo "0x80\t3\t\tDUP1\tDuplicate 1st stack item\n"; break;
case 0x81: echo "0x81\t3\t\tDUP2\tDuplicate 2nd stack item\n"; break;
case 0x82: echo "0x82\t3\t\tDUP3\tDuplicate 3rd stack item\n"; break;
case 0x83: echo "0x83\t3\t\tDUP4\tDuplicate 4th stack item\n"; break;
case 0x84: echo "0x84\t3\t\tDUP5\tDuplicate 5th stack item\n"; break;
case 0x85: echo "0x85\t3\t\tDUP6\tDuplicate 6th stack item\n"; break;
case 0x86: echo "0x86\t3\t\tDUP7\tDuplicate 7th stack item\n"; break;
case 0x87: echo "0x87\t3\t\tDUP8\tDuplicate 8th stack item\n"; break;
case 0x88: echo "0x88\t3\t\tDUP9\tDuplicate 9th stack item\n"; break;
case 0x89: echo "0x89\t3\t\tDUP10\tDuplicate 10th stack item\n"; break;
case 0x8a: echo "0x8a\t3\t\tDUP11\tDuplicate 11th stack item\n"; break;
case 0x8b: echo "0x8b\t3\t\tDUP12\tDuplicate 12th stack item\n"; break;
case 0x8c: echo "0x8c\t3\t\tDUP13\tDuplicate 13th stack item\n"; break;
case 0x8d: echo "0x8d\t3\t\tDUP14\tDuplicate 14th stack item\n"; break;
case 0x8e: echo "0x8e\t3\t\tDUP15\tDuplicate 15th stack item\n"; break;
case 0x8f: echo "0x8f\t3\t\tDUP16\tDuplicate 16th stack item\n"; break;
case 0x90: echo "0x90\t3\t\tSWAP1\tExchange 1st and 2nd stack items\n"; break;
case 0x91: echo "0x91\t3\t\tSWAP2\tExchange 1st and 3rd stack items\n"; break;
case 0x92: echo "0x92\t3\t\tSWAP3\tExchange 1st and 4th stack items\n"; break;
case 0x93: echo "0x93\t3\t\tSWAP4\tExchange 1st and 5th stack items\n"; break;
case 0x94: echo "0x94\t3\t\tSWAP5\tExchange 1st and 6th stack items\n"; break;
case 0x95: echo "0x95\t3\t\tSWAP6\tExchange 1st and 7th stack items\n"; break;
case 0x96: echo "0x96\t3\t\tSWAP7\tExchange 1st and 8th stack items\n"; break;
case 0x97: echo "0x97\t3\t\tSWAP8\tExchange 1st and 9th stack items\n"; break;
case 0x98: echo "0x98\t3\t\tSWAP9\tExchange 1st and 10th stack items\n"; break;
case 0x99: echo "0x99\t3\t\tSWAP10\tExchange 1st and 11th stack items\n"; break;
case 0x9a: echo "0x9a\t3\t\tSWAP11\tExchange 1st and 12th stack items\n"; break;
case 0x9b: echo "0x9b\t3\t\tSWAP12\tExchange 1st and 13th stack items\n"; break;
case 0x9c: echo "0x9c\t3\t\tSWAP13\tExchange 1st and 14th stack items\n"; break;
case 0x9d: echo "0x9d\t3\t\tSWAP14\tExchange 1st and 15th stack items\n"; break;
case 0x9e: echo "0x9e\t3\t\tSWAP15\tExchange 1st and 16th stack items\n"; break;
case 0x9f: echo "0x9f\t3\t\tSWAP16\tExchange 1st and 17th stack items\n"; break;
case 0xa0: echo "0xa0\t375\t\tLOG0\tAppend log record with no topics\n"; break;
case 0xa1: echo "0xa1\t750\t\tLOG1\tAppend log record with one topic\n"; break;
case 0xa2: echo "0xa2\t1125\t\tLOG2\tAppend log record with two topics\n"; break;
case 0xa3: echo "0xa3\t1500\t\tLOG3\tAppend log record with three topics\n"; break;
case 0xa4: echo "0xa4\t1875\t\tLOG4\tAppend log record with four topics\n"; break;
case 0xf0: echo "0xf0\t32000\t\tCREATE\tCreate a new account with associated code\n"; break;
case 0xf1: echo "0xf1\t40\t\tCALL\tMessage-call into an account\n"; break;
case 0xf2: echo "0xf2\t40\t\tCALLCODE\tMessage-call into this account with alternative account’s code\n"; break;
case 0xf3: echo "0xf3\t0\t\tRETURN\tHalt execution returning output data\n"; break;
case 0xf4: echo "0xf4\t40\t\tDELEGATECALL\tMessage-call into this account with an alternative account’s code, but persisting the current values for sender and value\n"; break;
//0xfe_jj11_INVALID_s_NaN_s_Designated invalid instruction
case 0xff: echo "0xff\t0\t\tSELFDESTRUCT\tHalt execution and register account for later deletion\n"; break;



		}
	}
}

/*
opcodes vm memory stack parameters test
*/
?>