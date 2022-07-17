<?php
namespace App\Suiteziel\Vm;


use App\Suiteziel\Vm;
use App\Suiteziel\Vm\Opcodes;
use App\Suiteziel\Vm\Memory;
use App\Suiteziel\Vm\Stack;
use App\Suiteziel\Org\Diamonds;

class Box extends Vm
{
	public $aHex;
	public $i_pc; //program counter
	
	public $oOpcodes;
	public $oMemory;
	public $oStack;

	function __construct() {
		$this->i_pc = 0;
		$this->oOpcodes = new Opcodes();
		$this->oMemory = new Memory();
		$this->oStack = new Stack();
	}

	public function set_hex() :bool {
		$this->aHex = Diamonds::$_aHex;
		return true;
	}

	public function implement (): bool {
		//if (!$this->set_hex() && empty($this->aHex)) die('Box->implement');
		
		
		$this->aHex = array(
			//0x60, 0x02, 0x60, 0x03, 0x01, //STOP
			0x60, 0x02, 0x60, 0x03, 0x01, //ADD
			0x60, 0x64, 0x02, //MUL
			0x60, 0x258, 0x03, //SUB
			0x60, 0x1770, 0x04, //DIV
			0x60, 0x1770, 0x05, //SDIV
			0x60, 0x0A, 0x06, //MOD
			0x60, 0x02, 0x07, //SMOD
			0x60, 0x64, 0x60, 0x64, 0x08, //ADDMOD
			0x60, 0x02, 0x60, 0x02, 0x09, //MULMOD
			0x60, 0x02, 0x0a, //EXP
			//0x60, 0x64, 0x0b, //SIGNEXTEND
			0x60, 0x64, 0x10, //LT
			0x60, 0x01, 0x60, 0x02, 0x11, //GT
			0x60, 0x64, 0x12, //SLT
			0x60, 0x64, 0x13, //SGT
			0x60, 0x64, 0x14, //EQ
			0x60, 0x64, 0x15, //ISZERO
			0x60, 0x64, 0x16, //AND
			0x60, 0x64, 0x17, //OR
			0x60, 0x64, 0x18, //XOR
			0x60, 0x64, 0x19, //NOT
			0x60, 0x64, 0x1a, //BYTE
			
			0x60, 0x64, 0x1b, //SHL 
			0x60, 0x64, 0x1c, //SHR 
			0x60, 0x64, 0x1d, //SAR 
			
			0x60, 0x64, 0x20, //SHA3

			0x60, 0x64, 0x30, //ADDRESS
			//0x60, 0x64, 0x31, //BALANCE
			//0x60, 0x64, 0x32, //ORIGIN
			//0x60, 0x64, 0x33, //CALLER
			//0x60, 0x64, 0x34, //CALLVALUE
			//0x60, 0x64, 0x35, //CALLDATALOAD
			//0x60, 0x64, 0x36, //CALLDATASIZE
			//0x60, 0x64, 0x37, //CALLDATACOPY
			//0x60, 0x64, 0x38, //CODESIZE
			//0x60, 0x64, 0x39, //CODECOPY
			//0x60, 0x64, 0x3a, //GASPRICE
			//0x60, 0x64, 0x3b, //EXTCODESIZE
			//0x60, 0x64, 0x3c, //EXTCODECOPY
			//0x60, 0x64, 0x40, //BLOCKHASH
			//0x60, 0x64, 0x41, //COINBASE
			//0x60, 0x64, 0x42, //TIMESTAMP
			//0x60, 0x64, 0x43, //NUMBER
			//0x60, 0x64, 0x44, //DIFFICULTY
			//0x60, 0x64, 0x45, //GASLIMIT
			//0x60, 0x64, 0x50, //POP
			//0x60, 0x64, 0x51, //MLOAD
			//0x60, 0x64, 0x52, //MSTORE
			//0x60, 0x64, 0x53, //MSTORE8
			//0x60, 0x64, 0x54, //SLOAD
			//0x60, 0x64, 0x55, //SSTORE
			//0x60, 0x64, 0x56, //JUMP
			//0x60, 0x64, 0x57, //JUMPI
			//0x60, 0x64, 0x58, //PC
			//0x60, 0x64, 0x59, //MSIZE
			//0x60, 0x64, 0x5a, //GAS
			//0x60, 0x64, 0x5b, //JUMPDEST
			//0x60, 0x64, 0x60, //PUSH1
			//0x60, 0x64, 0x61, //PUSH2
			//0x60, 0x64, 0x62, //PUSH3
			//0x60, 0x64, 0x63, //PUSH4
			//0x60, 0x64, 0x64, //PUSH5
			//0x60, 0x64, 0x65, //PUSH6
			//0x60, 0x64, 0x66, //PUSH7
			//0x60, 0x64, 0x67, //PUSH8
			//0x60, 0x64, 0x68, //PUSH9
			//0x60, 0x64, 0x69, //PUSH10
			//0x60, 0x64, 0x6a, //PUSH11
			//0x60, 0x64, 0x6b, //PUSH12
			//0x60, 0x64, 0x6c, //PUSH13
			//0x60, 0x64, 0x6d, //PUSH14
			//0x60, 0x64, 0x6e, //PUSH15
			//0x60, 0x64, 0x6f, //PUSH16
			//0x60, 0x64, 0x70, //PUSH17
			//0x60, 0x64, 0x71, //PUSH18
			//0x60, 0x64, 0x72, //PUSH19
			//0x60, 0x64, 0x73, //PUSH20
			//0x60, 0x64, 0x74, //PUSH21
			//0x60, 0x64, 0x75, //PUSH22
			//0x60, 0x64, 0x76, //PUSH23
			//0x60, 0x64, 0x77, //PUSH24
			//0x60, 0x64, 0x78, //PUSH25
			//0x60, 0x64, 0x79, //PUSH26
			//0x60, 0x64, 0x7a, //PUSH27
			//0x60, 0x64, 0x7b, //PUSH28
			//0x60, 0x64, 0x7c, //PUSH29
			//0x60, 0x64, 0x7d, //PUSH30
			//0x60, 0x64, 0x7e, //PUSH31
			//0x60, 0x64, 0x7f, //PUSH32
			//0x60, 0x64, 0x80, //DUP1
			//0x60, 0x64, 0x81, //DUP2
			//0x60, 0x64, 0x82, //DUP3
			//0x60, 0x64, 0x83, //DUP4
			//0x60, 0x64, 0x84, //DUP5
			//0x60, 0x64, 0x85, //DUP6
			//0x60, 0x64, 0x86, //DUP7
			//0x60, 0x64, 0x87, //DUP8
			//0x60, 0x64, 0x88, //DUP9
			//0x60, 0x64, 0x89, //DUP10
			//0x60, 0x64, 0x8a, //DUP11
			//0x60, 0x64, 0x8b, //DUP12
			//0x60, 0x64, 0x8c, //DUP13
			//0x60, 0x64, 0x8d, //DUP14
			//0x60, 0x64, 0x8e, //DUP15
			//0x60, 0x64, 0x8f, //DUP16
			//0x60, 0x64, 0x90, //SWAP1
			//0x60, 0x64, 0x91, //SWAP2
			//0x60, 0x64, 0x92, //SWAP3
			//0x60, 0x64, 0x93, //SWAP4
			//0x60, 0x64, 0x94, //SWAP5
			//0x60, 0x64, 0x95, //SWAP6
			//0x60, 0x64, 0x96, //SWAP7
			//0x60, 0x64, 0x97, //SWAP8
			//0x60, 0x64, 0x98, //SWAP9
			//0x60, 0x64, 0x99, //SWAP10
			//0x60, 0x64, 0x9a, //SWAP11
			//0x60, 0x64, 0x9b, //SWAP12
			//0x60, 0x64, 0x9c, //SWAP13
			//0x60, 0x64, 0x9d, //SWAP14
			//0x60, 0x64, 0x9e, //SWAP15
			//0x60, 0x64, 0x9f, //SWAP16
			//0x60, 0x64, 0xa0, //LOG0
			//0x60, 0x64, 0xa1, //LOG1
			//0x60, 0x64, 0xa2, //LOG2
			//0x60, 0x64, 0xa3, //LOG3
			//0x60, 0x64, 0xa4, //LOG4
			//0x60, 0x64, 0xf0, //CREATE
			//0x60, 0x64, 0xf1, //CALL
			//0x60, 0x64, 0xf2, //CALLCODE
			//0x60, 0x64, 0xf3, //RETURN
			//0x60, 0x64, 0xf4, //DELEGATECALL
			//0xfe_jj11_INVALID_s_NaN_s_Designated invalid instruction
			//0x60, 0x64, 0xff, //SELFDESTRUCT

		);

		
		if (!$this->oOpcodes->hex_set($this->aHex)) die('oOpcodes->hex_set');
		
		$i_opargs = 0;
		foreach ($this->aHex as $k => $sHex) {
			if ($i_opargs !== 0) {
				$i_opargs--;
				continue; 
			}
		
			if (!$this->oOpcodes->initiate($k, $sHex)) die('oOpcodes->initiate'); // view
			if (!$this->oOpcodes->describe($k, $sHex)) die('oOpcodes->describe');
			
			$this->oStack->arguments_set($this->oOpcodes->aArguments);
			
			
			//var_dump($this->oOpcodes->aaOpcodes[$sHex]);
			
			$this->oStack->delta_set($this->oOpcodes->aaOpcodes[$sHex][1]);
			if (!$this->oStack->positioning($k, $sHex)) die('oStack->positioning');

			$i_opargs = count($this->oOpcodes->aArguments);
			
		}
		
		var_dump('$this->oStack->aaStack');
		var_dump($this->oStack->aaStack);
		return true;
	}

}

?>