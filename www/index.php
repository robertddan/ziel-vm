<?php

require __DIR__.'/../config/bootstrap.php';

echo '<pre>';


use App\Suiteziel\Org\Diamonds;
use App\Suiteziel\Vm\Opcodes;
use App\Suiteziel\Vm\Stack;
use App\Suiteziel\Vm\Box;


$oDiamonds = new Diamonds();
$oOpcodes = new Opcodes();
$oBox = new Box();


$oDiamonds->iCursor = 1; // skip compilation
$oDiamonds->sContract = 'Storage.sol'; // contract file name in contracts folder
$oDiamonds->sFolder = '20220714115532000000'; // specify folder
if (!$oDiamonds->set_output_folder()) die('oDiamonds->set_output_folder'); //set it
if (!$oDiamonds->compile_contract()) die('oDiamonds->compile_contract');
if (!$oDiamonds->iCursor) die('oDiamonds->iCursor');
if (!$oDiamonds->read_from_file()) die('oDiamonds->read_from_file');
var_dump($oDiamonds->sHex);
if (!$oDiamonds->decode_hex()) die('oDiamonds->decode_hex');

$aHex = $oDiamonds->hex_get();
$aHexBased = array();
	
	
foreach ($aHex as $k => $sHex) {
	$iBase = $oDiamonds->hex_base_convert($sHex);
	array_push($aHexBased, $iBase);
}

$oOpcodes->hex_set($aHexBased);
var_dump(implode(",", $aHexBased));


$iCountArguments = 0;

foreach ($aHexBased as $k => $sHex) {
	if ($iCountArguments !== 0) {
		$iCountArguments = $iCountArguments - 1;
		continue;
	}

	if (!$oOpcodes->initiate($k, $sHex)) die('oOpcodes->initiate');
	if (!$oOpcodes->describe($k, $sHex)) die('oOpcodes->describe');
	$iCountArguments = count($oOpcodes->aArguments);
	//if (!$oBox->implement($oOpcodes, $sHex)) die('oBox->implement');
	
	//var_dump($oOpcodes->aaStack);

}


/*
000 PUSH1 80
002 PUSH1 40
004 MSTORE
005 CALLVALUE
006 DUP1
007 ISZERO
008 PUSH2 0010
011 JUMPI
012 PUSH1 00
014 DUP1
015 REVERT
016 JUMPDEST
017 POP
018 PUSH2 0150
021 DUP1
022 PUSH2 0020
025 PUSH1 00
027 CODECOPY
028 PUSH1 00
030 RETURN
031 INVALID
032 PUSH1 80
034 PUSH1 40
036 MSTORE
037 CALLVALUE
038 DUP1
039 ISZERO
040 PUSH2 0010
043 JUMPI
044 PUSH1 00
046 DUP1
047 REVERT
048 JUMPDEST
049 POP
050 PUSH1 04
052 CALLDATASIZE
053 LT
054 PUSH2 0036
057 JUMPI
058 PUSH1 00
060 CALLDATALOAD
061 PUSH1 e0
063 SHR
064 DUP1
065 PUSH4 2e64cec1
070 EQ
071 PUSH2 003b
074 JUMPI
075 DUP1
076 PUSH4 6057361d
081 EQ
082 PUSH2 0059
085 JUMPI
086 JUMPDEST
087 PUSH1 00
089 DUP1
090 REVERT
091 JUMPDEST
092 PUSH2 0043
095 PUSH2 0075
098 JUMP
099 JUMPDEST
100 PUSH1 40
102 MLOAD
103 PUSH2 0050
106 SWAP2
107 SWAP1
108 PUSH2 00d9
111 JUMP
112 JUMPDEST
113 PUSH1 40
115 MLOAD
116 DUP1
117 SWAP2
118 SUB
119 SWAP1
120 RETURN
121 JUMPDEST
122 PUSH2 0073
125 PUSH1 04
127 DUP1
128 CALLDATASIZE
129 SUB
130 DUP2
131 ADD
132 SWAP1
133 PUSH2 006e
136 SWAP2
137 SWAP1
138 PUSH2 009d
141 JUMP
142 JUMPDEST
143 PUSH2 007e
146 JUMP
147 JUMPDEST
148 STOP
149 JUMPDEST
150 PUSH1 00
152 DUP1
153 SLOAD
*/
?>