<?php
namespace App\Suiteziel\Vm;


class Opcodes
{
	public function test($iKey = null) {
		
		switch ($iKey) {
			case 0x00: echo "0x00\tSTOP\t\t0\tHalts execution"; break;
			case 0x01: echo "0x01\tADD\t\t3\tAddition operation"; break;
			case 0x02: echo "0x02\tMUL\t\t5\tMultiplication operation"; break;
			case 0x03: echo "0x03\tSUB\t\t3\tSubtraction operation"; break;
			case 0x04: echo "0x04\tDIV\t\t5\tInteger division operation"; break;
			case 0x05: echo "0x05\tSDIV\t\t5\tSigned integer division operation (truncated)"; break;
			case 0x06: echo "0x06\tMOD\t\t5\tModulo remainder operation"; break;
			case 0x07: echo "0x07\tSMOD\t\t5\tSigned modulo remainder operation"; break;
			case 0x08: echo "0x08\tADDMOD\t\t8\tModulo addition operation"; break;
			case 0x09: echo "0x09\tMULMOD\t\t8\tModulo multiplication operation"; break;
			case 0x0a: echo "0x0a\tEXP\t\t10\tExponential operation"; break;
			case 0x0b: echo "0x0b\tSIGNEXTEND\t\t5\tExtend length of two’s complement signed integer"; break;
			case 0x10: echo "0x10\tLT\t\t3\tLess-than comparison"; break;
			case 0x11: echo "0x11\tGT\t\t3\tGreater-than comparison"; break;
			case 0x12: echo "0x12\tSLT\t\t3\tSigned less-than comparison"; break;
			case 0x13: echo "0x13\tSGT\t\t3\tSigned greater-than comparison"; break;
			case 0x14: echo "0x14\tEQ\t\t3\tEquality comparison"; break;
			case 0x15: echo "0x15\tISZERO\t\t3\tSimple not operator"; break;
			case 0x16: echo "0x16\tAND\t\t3\tBitwise AND operation"; break;
			case 0x17: echo "0x17\tOR\t\t3\tBitwise OR operation"; break;
			case 0x18: echo "0x18\tXOR\t\t3\tBitwise XOR operation"; break;
			case 0x19: echo "0x19\tNOT\t\t3\tBitwise NOT operation"; break;
			case 0x1a: echo "0x1a\tBYTE\t\t3\tRetrieve single byte from word"; break;
			case 0x20: echo "0x20\tSHA3\t\t30\tCompute Keccak-256 hash"; break;
			case 0x30: echo "0x30\tADDRESS\t\t2\tGet address of currently executing account"; break;
			case 0x31: echo "0x31\tBALANCE\t\t20\tGet balance of the given account"; break;
			case 0x32: echo "0x32\tORIGIN\t\t2\tGet execution origination address"; break;
			case 0x33: echo "0x33\tCALLER\t\t2\tGet caller address"; break;
			case 0x34: echo "0x34\tCALLVALUE\t\t2\tGet deposited value by the instruction/transaction responsible for this execution"; break;
			case 0x35: echo "0x35\tCALLDATALOAD\t\t3\tGet input data of current environment"; break;
			case 0x36: echo "0x36\tCALLDATASIZE\t\t2\tGet size of input data in current environment"; break;
			case 0x37: echo "0x37\tCALLDATACOPY\t\t3\tCopy input data in current environment to memory"; break;
			case 0x38: echo "0x38\tCODESIZE\t\t2\tGet size of code running in current environment"; break;
			case 0x39: echo "0x39\tCODECOPY\t\t3\tCopy code running in current environment to memory"; break;
			case 0x3a: echo "0x3a\tGASPRICE\t\t2\tGet price of gas in current environment"; break;
			case 0x3b: echo "0x3b\tEXTCODESIZE\t\t20\tGet size of an account’s code"; break;
			case 0x3c: echo "0x3c\tEXTCODECOPY\t\t20\tCopy an account’s code to memory"; break;
			case 0x40: echo "0x40\tBLOCKHASH\t\t20\tGet the hash of one of the 256 most recent complete blocks"; break;
			case 0x41: echo "0x41\tCOINBASE\t\t2\tGet the block’s beneficiary address"; break;
			case 0x42: echo "0x42\tTIMESTAMP\t\t2\tGet the block’s timestamp"; break;
			case 0x43: echo "0x43\tNUMBER\t\t2\tGet the block’s number"; break;
			case 0x44: echo "0x44\tDIFFICULTY\t\t2\tGet the block’s difficulty"; break;
			case 0x45: echo "0x45\tGASLIMIT\t\t2\tGet the block’s gas limit"; break;
			case 0x50: echo "0x50\tPOP\t\t2\tRemove item from stack"; break;
			case 0x51: echo "0x51\tMLOAD\t\t3\tLoad word from memory"; break;
			case 0x52: echo "0x52\tMSTORE\t\t3\tSave word to memory"; break;
			case 0x53: echo "0x53\tMSTORE8\t\t3\tSave byte to memory"; break;
			case 0x54: echo "0x54\tSLOAD\t\t50\tLoad word from storage"; break;
			case 0x55: echo "0x55\tSSTORE\t\t5000\tSave word to storage"; break;
			case 0x56: echo "0x56\tJUMP\t\t8\tAlter the program counter"; break;
			case 0x57: echo "0x57\tJUMPI\t\t10\tConditionally alter the program counter"; break;
			case 0x58: echo "0x58\tPC\t\t2\tGet the value of the program counter prior to the increment corresponding to this instruction"; break;
			case 0x59: echo "0x59\tMSIZE\t\t2\tGet the size of active memory in bytes"; break;
			case 0x5a: echo "0x5a\tGAS\t\t2\tGet the amount of available gas, including the corresponding reduction for the cost of this instruction"; break;
			case 0x5b: echo "0x5b\tJUMPDEST\t\t1\tMark a valid destination for jumps"; break;
			case 0x60: echo "0x60\tPUSH1\t\t3\tPlace 1 byte item on stack"; break;
			case 0x61: echo "0x61\tPUSH2\t\t3\tPlace 2 byte item on stack"; break;
			case 0x62: echo "0x62\tPUSH3\t\t3\tPlace 3 byte item on stack"; break;
			case 0x63: echo "0x63\tPUSH4\t\t3\tPlace 4 byte item on stack"; break;
			case 0x64: echo "0x64\tPUSH5\t\t3\tPlace 5 byte item on stack"; break;
			case 0x65: echo "0x65\tPUSH6\t\t3\tPlace 6 byte item on stack"; break;
			case 0x66: echo "0x66\tPUSH7\t\t3\tPlace 7 byte item on stack"; break;
			case 0x67: echo "0x67\tPUSH8\t\t3\tPlace 8 byte item on stack"; break;
			case 0x68: echo "0x68\tPUSH9\t\t3\tPlace 9 byte item on stack"; break;
			case 0x69: echo "0x69\tPUSH10\t\t3\tPlace 10 byte item on stack"; break;
			case 0x6a: echo "0x6a\tPUSH11\t\t3\tPlace 11 byte item on stack"; break;
			case 0x6b: echo "0x6b\tPUSH12\t\t3\tPlace 12 byte item on stack"; break;
			case 0x6c: echo "0x6c\tPUSH13\t\t3\tPlace 13 byte item on stack"; break;
			case 0x6d: echo "0x6d\tPUSH14\t\t3\tPlace 14 byte item on stack"; break;
			case 0x6e: echo "0x6e\tPUSH15\t\t3\tPlace 15 byte item on stack"; break;
			case 0x6f: echo "0x6f\tPUSH16\t\t3\tPlace 16 byte item on stack"; break;
			case 0x70: echo "0x70\tPUSH17\t\t3\tPlace 17 byte item on stack"; break;
			case 0x71: echo "0x71\tPUSH18\t\t3\tPlace 18 byte item on stack"; break;
			case 0x72: echo "0x72\tPUSH19\t\t3\tPlace 19 byte item on stack"; break;
			case 0x73: echo "0x73\tPUSH20\t\t3\tPlace 20 byte item on stack"; break;
			case 0x74: echo "0x74\tPUSH21\t\t3\tPlace 21 byte item on stack"; break;
			case 0x75: echo "0x75\tPUSH22\t\t3\tPlace 22 byte item on stack"; break;
			case 0x76: echo "0x76\tPUSH23\t\t3\tPlace 23 byte item on stack"; break;
			case 0x77: echo "0x77\tPUSH24\t\t3\tPlace 24 byte item on stack"; break;
			case 0x78: echo "0x78\tPUSH25\t\t3\tPlace 25 byte item on stack"; break;
			case 0x79: echo "0x79\tPUSH26\t\t3\tPlace 26 byte item on stack"; break;
			case 0x7a: echo "0x7a\tPUSH27\t\t3\tPlace 27 byte item on stack"; break;
			case 0x7b: echo "0x7b\tPUSH28\t\t3\tPlace 28 byte item on stack"; break;
			case 0x7c: echo "0x7c\tPUSH29\t\t3\tPlace 29 byte item on stack"; break;
			case 0x7d: echo "0x7d\tPUSH30\t\t3\tPlace 30 byte item on stack"; break;
			case 0x7e: echo "0x7e\tPUSH31\t\t3\tPlace 31 byte item on stack"; break;
			case 0x7f: echo "0x7f\tPUSH32\t\t3\tPlace 32 byte (full word) item on stack"; break;
			case 0x80: echo "0x80\tDUP1\t\t3\tDuplicate 1st stack item"; break;
			case 0x81: echo "0x81\tDUP2\t\t3\tDuplicate 2nd stack item"; break;
			case 0x82: echo "0x82\tDUP3\t\t3\tDuplicate 3rd stack item"; break;
			case 0x83: echo "0x83\tDUP4\t\t3\tDuplicate 4th stack item"; break;
			case 0x84: echo "0x84\tDUP5\t\t3\tDuplicate 5th stack item"; break;
			case 0x85: echo "0x85\tDUP6\t\t3\tDuplicate 6th stack item"; break;
			case 0x86: echo "0x86\tDUP7\t\t3\tDuplicate 7th stack item"; break;
			case 0x87: echo "0x87\tDUP8\t\t3\tDuplicate 8th stack item"; break;
			case 0x88: echo "0x88\tDUP9\t\t3\tDuplicate 9th stack item"; break;
			case 0x89: echo "0x89\tDUP10\t\t3\tDuplicate 10th stack item"; break;
			case 0x8a: echo "0x8a\tDUP11\t\t3\tDuplicate 11th stack item"; break;
			case 0x8b: echo "0x8b\tDUP12\t\t3\tDuplicate 12th stack item"; break;
			case 0x8c: echo "0x8c\tDUP13\t\t3\tDuplicate 13th stack item"; break;
			case 0x8d: echo "0x8d\tDUP14\t\t3\tDuplicate 14th stack item"; break;
			case 0x8e: echo "0x8e\tDUP15\t\t3\tDuplicate 15th stack item"; break;
			case 0x8f: echo "0x8f\tDUP16\t\t3\tDuplicate 16th stack item"; break;
			case 0x90: echo "0x90\tSWAP1\t\t3\tExchange 1st and 2nd stack items"; break;
			case 0x91: echo "0x91\tSWAP2\t\t3\tExchange 1st and 3rd stack items"; break;
			case 0x92: echo "0x92\tSWAP3\t\t3\tExchange 1st and 4th stack items"; break;
			case 0x93: echo "0x93\tSWAP4\t\t3\tExchange 1st and 5th stack items"; break;
			case 0x94: echo "0x94\tSWAP5\t\t3\tExchange 1st and 6th stack items"; break;
			case 0x95: echo "0x95\tSWAP6\t\t3\tExchange 1st and 7th stack items"; break;
			case 0x96: echo "0x96\tSWAP7\t\t3\tExchange 1st and 8th stack items"; break;
			case 0x97: echo "0x97\tSWAP8\t\t3\tExchange 1st and 9th stack items"; break;
			case 0x98: echo "0x98\tSWAP9\t\t3\tExchange 1st and 10th stack items"; break;
			case 0x99: echo "0x99\tSWAP10\t\t3\tExchange 1st and 11th stack items"; break;
			case 0x9a: echo "0x9a\tSWAP11\t\t3\tExchange 1st and 12th stack items"; break;
			case 0x9b: echo "0x9b\tSWAP12\t\t3\tExchange 1st and 13th stack items"; break;
			case 0x9c: echo "0x9c\tSWAP13\t\t3\tExchange 1st and 14th stack items"; break;
			case 0x9d: echo "0x9d\tSWAP14\t\t3\tExchange 1st and 15th stack items"; break;
			case 0x9e: echo "0x9e\tSWAP15\t\t3\tExchange 1st and 16th stack items"; break;
			case 0x9f: echo "0x9f\tSWAP16\t\t3\tExchange 1st and 17th stack items"; break;
			case 0xa0: echo "0xa0\tLOG0\t\t375\tAppend log record with no topics"; break;
			case 0xa1: echo "0xa1\tLOG1\t\t750\tAppend log record with one topic"; break;
			case 0xa2: echo "0xa2\tLOG2\t\t1125\tAppend log record with two topics"; break;
			case 0xa3: echo "0xa3\tLOG3\t\t1500\tAppend log record with three topics"; break;
			case 0xa4: echo "0xa4\tLOG4\t\t1875\tAppend log record with four topics"; break;
			case 0xf0: echo "0xf0\tCREATE\t\t32000\tCreate a new account with associated code"; break;
			case 0xf1: echo "0xf1\tCALL\t\t40\tMessage-call into an account"; break;
			case 0xf2: echo "0xf2\tCALLCODE\t\t40\tMessage-call into this account with alternative account’s code"; break;
			case 0xf3: echo "0xf3\tRETURN\t\t0\tHalt execution returning output data"; break;
			case 0xf4: echo "0xf4\tDELEGATECALL\t\t40\tMessage-call into this account with an alternative account’s code, but persisting the current values for sender and value"; break;
			//0xfe_jj11_INVALID_s_NaN_s_Designated invalid instruction
			case 0xff: echo "0xff\tSELFDESTRUCT\t\t0\tHalt execution and register account for later deletion"; break;

		}
	}
}

/*
opcodes vm memory stack parameters test
*/
?>