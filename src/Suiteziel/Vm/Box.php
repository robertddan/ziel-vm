<?php
namespace App\Suiteziel\Vm;


class Box
{
/*
pub fn decode(s: &str) -> Result<Vec<u8>, ParseIntError> {
	(0..(s.len()-1))
		.step_by(2)
		.map(|i| u8::from_str_radix(&s[i..i+2], 16))
		.collect()
}
*/
	function __construct() {
		print "In BaseClass constructor\n";
	}	
	public function new_from_call($sJson = null, $aParameters = null) {
		return  "Hello woorld Memory";
	}
	public function new_from_cli($sJsonHex = null, $aParameters = null) {
		return  "Hello woorld Memory";
	}
	public function new_from_file($sFilePath = null, $aParameters = null) {
		return  "Hello woorld Memory";
	}
	public function decode($sHex = null){
		$aHex = str_split($sHex, 2);
		
		var_dump($aHex);
	}

}

/*
opcodes vm memory stack parameters test
*/
?>