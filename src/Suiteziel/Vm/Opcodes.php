<?php
namespace App\Suiteziel\Vm;


class Opcodes
{
	public function test($iKey = null) {
		
		switch ($iKey) {
case 0x00: echo "0x00\tSTOP\tHalts execution"; break;
case 0x01: echo "0x01\tADD\tAddition operation"; break;
case 0x02: echo "0x02\tMUL\tMultiplication operation"; break;
case 0x03: echo "0x03\tSUB\tSubtraction operation"; break;
case 0x04: echo "0x04\tDIV\tInteger division operation"; break;
case 0x05: echo "0x05\tSDIV\tSigned integer division operation (truncated)"; break;
case 0x06: echo "0x06\tMOD\tModulo remainder operation"; break;
case 0x07: echo "0x07\tSMOD\tSigned modulo remainder operation"; break;
case 0x08: echo "0x08\tADDMOD\tModulo addition operation"; break;
case 0x09: echo "0x09\tMULMOD\tModulo multiplication operation"; break;
case 0x0a: echo "0x0a\tEXP\tExponential operation"; break;
case 0x0b: echo "0x0b\tSIGNEXTEND\tExtend length of two’s complement signed integer"; break;
case 0x10: echo "0x10\tLT\tLess-than comparison"; break;
case 0x11: echo "0x11\tGT\tGreater-than comparison"; break;
case 0x12: echo "0x12\tSLT\tSigned less-than comparison"; break;
case 0x13: echo "0x13\tSGT\tSigned greater-than comparison"; break;
case 0x14: echo "0x14\tEQ\tEquality comparison"; break;
case 0x15: echo "0x15\tISZERO\tSimple not operator"; break;
case 0x16: echo "0x16\tAND\tBitwise AND operation"; break;
case 0x17: echo "0x17\tOR\tBitwise OR operation"; break;
case 0x18: echo "0x18\tXOR\tBitwise XOR operation"; break;
case 0x19: echo "0x19\tNOT\tBitwise NOT operation"; break;
case 0x1a: echo "0x1a\tBYTE\tRetrieve single byte from word"; break;
case 0x20: echo "0x20\tSHA3\tCompute Keccak-256 hash"; break;
case 0x30: echo "0x30\tADDRESS\tGet address of currently executing account"; break;
case 0x31: echo "0x31\tBALANCE\tGet balance of the given account"; break;
case 0x32: echo "0x32\tORIGIN\tGet execution origination address"; break;
case 0x33: echo "0x33\tCALLER\tGet caller address"; break;
case 0x34: echo "0x34\tCALLVALUE\tGet deposited value by the instruction/transaction responsible for this execution"; break;
case 0x35: echo "0x35\tCALLDATALOAD\tGet input data of current environment"; break;
case 0x36: echo "0x36\tCALLDATASIZE\tGet size of input data in current environment"; break;
case 0x37: echo "0x37\tCALLDATACOPY\tCopy input data in current environment to memory"; break;
case 0x38: echo "0x38\tCODESIZE\tGet size of code running in current environment"; break;
case 0x39: echo "0x39\tCODECOPY\tCopy code running in current environment to memory"; break;
case 0x3a: echo "0x3a\tGASPRICE\tGet price of gas in current environment"; break;
case 0x3b: echo "0x3b\tEXTCODESIZE\tGet size of an account’s code"; break;
case 0x3c: echo "0x3c\tEXTCODECOPY\tCopy an account’s code to memory"; break;
case 0x40: echo "0x40\tBLOCKHASH\tGet the hash of one of the 256 most recent complete blocks"; break;
case 0x41: echo "0x41\tCOINBASE\tGet the block’s beneficiary address"; break;
case 0x42: echo "0x42\tTIMESTAMP\tGet the block’s timestamp"; break;
case 0x43: echo "0x43\tNUMBER\tGet the block’s number"; break;
case 0x44: echo "0x44\tDIFFICULTY\tGet the block’s difficulty"; break;
case 0x45: echo "0x45\tGASLIMIT\tGet the block’s gas limit"; break;
case 0x50: echo "0x50\tPOP\tRemove item from stack"; break;
case 0x51: echo "0x51\tMLOAD\tLoad word from memory"; break;
case 0x52: echo "0x52\tMSTORE\tSave word to memory"; break;
case 0x53: echo "0x53\tMSTORE8\tSave byte to memory"; break;
case 0x54: echo "0x54\tSLOAD\tLoad word from storage"; break;
case 0x55: echo "0x55\tSSTORE\tSave word to storage"; break;
case 0x56: echo "0x56\tJUMP\tAlter the program counter"; break;
case 0x57: echo "0x57\tJUMPI\tConditionally alter the program counter"; break;
case 0x58: echo "0x58\tPC\tGet the value of the program counter prior to the increment corresponding to this instruction"; break;
case 0x59: echo "0x59\tMSIZE\tGet the size of active memory in bytes"; break;
case 0x5a: echo "0x5a\tGAS\tGet the amount of available gas, including the corresponding reduction for the cost of this instruction"; break;
case 0x5b: echo "0x5b\tJUMPDEST\tMark a valid destination for jumps"; break;
case 0x60: echo "0x60\tPUSH1\tPlace 1 byte item on stack"; break;
case 0x61: echo "0x61\tPUSH2\tPlace 2 byte item on stack"; break;
case 0x62: echo "0x62\tPUSH3\tPlace 3 byte item on stack"; break;
case 0x63: echo "0x63\tPUSH4\tPlace 4 byte item on stack"; break;
case 0x64: echo "0x64\tPUSH5\tPlace 5 byte item on stack"; break;
case 0x65: echo "0x65\tPUSH6\tPlace 6 byte item on stack"; break;
case 0x66: echo "0x66\tPUSH7\tPlace 7 byte item on stack"; break;
case 0x67: echo "0x67\tPUSH8\tPlace 8 byte item on stack"; break;
case 0x68: echo "0x68\tPUSH9\tPlace 9 byte item on stack"; break;
case 0x69: echo "0x69\tPUSH10\tPlace 10 byte item on stack"; break;
case 0x6a: echo "0x6a\tPUSH11\tPlace 11 byte item on stack"; break;
case 0x6b: echo "0x6b\tPUSH12\tPlace 12 byte item on stack"; break;
case 0x6c: echo "0x6c\tPUSH13\tPlace 13 byte item on stack"; break;
case 0x6d: echo "0x6d\tPUSH14\tPlace 14 byte item on stack"; break;
case 0x6e: echo "0x6e\tPUSH15\tPlace 15 byte item on stack"; break;
case 0x6f: echo "0x6f\tPUSH16\tPlace 16 byte item on stack"; break;
case 0x70: echo "0x70\tPUSH17\tPlace 17 byte item on stack"; break;
case 0x71: echo "0x71\tPUSH18\tPlace 18 byte item on stack"; break;
case 0x72: echo "0x72\tPUSH19\tPlace 19 byte item on stack"; break;
case 0x73: echo "0x73\tPUSH20\tPlace 20 byte item on stack"; break;
case 0x74: echo "0x74\tPUSH21\tPlace 21 byte item on stack"; break;
case 0x75: echo "0x75\tPUSH22\tPlace 22 byte item on stack"; break;
case 0x76: echo "0x76\tPUSH23\tPlace 23 byte item on stack"; break;
case 0x77: echo "0x77\tPUSH24\tPlace 24 byte item on stack"; break;
case 0x78: echo "0x78\tPUSH25\tPlace 25 byte item on stack"; break;
case 0x79: echo "0x79\tPUSH26\tPlace 26 byte item on stack"; break;
case 0x7a: echo "0x7a\tPUSH27\tPlace 27 byte item on stack"; break;
case 0x7b: echo "0x7b\tPUSH28\tPlace 28 byte item on stack"; break;
case 0x7c: echo "0x7c\tPUSH29\tPlace 29 byte item on stack"; break;
case 0x7d: echo "0x7d\tPUSH30\tPlace 30 byte item on stack"; break;
case 0x7e: echo "0x7e\tPUSH31\tPlace 31 byte item on stack"; break;
case 0x7f: echo "0x7f\tPUSH32\tPlace 32 byte (full word) item on stack"; break;
case 0x80: echo "0x80\tDUP1\tDuplicate 1st stack item"; break;
case 0x81: echo "0x81\tDUP2\tDuplicate 2nd stack item"; break;
case 0x82: echo "0x82\tDUP3\tDuplicate 3rd stack item"; break;
case 0x83: echo "0x83\tDUP4\tDuplicate 4th stack item"; break;
case 0x84: echo "0x84\tDUP5\tDuplicate 5th stack item"; break;
case 0x85: echo "0x85\tDUP6\tDuplicate 6th stack item"; break;
case 0x86: echo "0x86\tDUP7\tDuplicate 7th stack item"; break;
case 0x87: echo "0x87\tDUP8\tDuplicate 8th stack item"; break;
case 0x88: echo "0x88\tDUP9\tDuplicate 9th stack item"; break;
case 0x89: echo "0x89\tDUP10\tDuplicate 10th stack item"; break;
case 0x8a: echo "0x8a\tDUP11\tDuplicate 11th stack item"; break;
case 0x8b: echo "0x8b\tDUP12\tDuplicate 12th stack item"; break;
case 0x8c: echo "0x8c\tDUP13\tDuplicate 13th stack item"; break;
case 0x8d: echo "0x8d\tDUP14\tDuplicate 14th stack item"; break;
case 0x8e: echo "0x8e\tDUP15\tDuplicate 15th stack item"; break;
case 0x8f: echo "0x8f\tDUP16\tDuplicate 16th stack item"; break;
case 0x90: echo "0x90\tSWAP1\tExchange 1st and 2nd stack items"; break;
case 0x91: echo "0x91\tSWAP2\tExchange 1st and 3rd stack items"; break;
case 0x92: echo "0x92\tSWAP3\tExchange 1st and 4th stack items"; break;
case 0x93: echo "0x93\tSWAP4\tExchange 1st and 5th stack items"; break;
case 0x94: echo "0x94\tSWAP5\tExchange 1st and 6th stack items"; break;
case 0x95: echo "0x95\tSWAP6\tExchange 1st and 7th stack items"; break;
case 0x96: echo "0x96\tSWAP7\tExchange 1st and 8th stack items"; break;
case 0x97: echo "0x97\tSWAP8\tExchange 1st and 9th stack items"; break;
case 0x98: echo "0x98\tSWAP9\tExchange 1st and 10th stack items"; break;
case 0x99: echo "0x99\tSWAP10\tExchange 1st and 11th stack items"; break;
case 0x9a: echo "0x9a\tSWAP11\tExchange 1st and 12th stack items"; break;
case 0x9b: echo "0x9b\tSWAP12\tExchange 1st and 13th stack items"; break;
case 0x9c: echo "0x9c\tSWAP13\tExchange 1st and 14th stack items"; break;
case 0x9d: echo "0x9d\tSWAP14\tExchange 1st and 15th stack items"; break;
case 0x9e: echo "0x9e\tSWAP15\tExchange 1st and 16th stack items"; break;
case 0x9f: echo "0x9f\tSWAP16\tExchange 1st and 17th stack items"; break;
case 0xa0: echo "0xa0\tLOG0\tAppend log record with no topics"; break;
case 0xa1: echo "0xa1\tLOG1\tAppend log record with one topic"; break;
case 0xa2: echo "0xa2\tLOG2\tAppend log record with two topics"; break;
case 0xa3: echo "0xa3\tLOG3\tAppend log record with three topics"; break;
case 0xa4: echo "0xa4\tLOG4\tAppend log record with four topics"; break;
case 0xf0: echo "0xf0\tCREATE\tCreate a new account with associated code"; break;
case 0xf1: echo "0xf1\tCALL\tMessage-call into an account"; break;
case 0xf2: echo "0xf2\tCALLCODE\tMessage-call into this account with alternative account’s code"; break;
case 0xf3: echo "0xf3\tRETURN\tHalt execution returning output data"; break;
case 0xf4: echo "0xf4\tDELEGATECALL\tMessage-call into this account with an alternative account’s code, but persisting the current values for sender and value"; break;
//0xfe_jj11_INVALID_s_NaN_s_Designated invalid instruction
case 0xff: echo "0xff\tSELFDESTRUCT\tHalt execution and register account for later deletion"; break;


		}
	}
}

/*
opcodes vm memory stack parameters test
*/
?>