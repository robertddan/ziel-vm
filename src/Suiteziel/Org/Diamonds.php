<?php
namespace App\Suiteziel\Org;


class Diamonds
{
		
	public function compile_contract($sFilePath = null) {
		if(empty($sFilePath)) return print '$sFilePath missing!';
		$sCommand = 'solc --bin-runtime --overwrite --asm --optimize -o . '.$sFilePath;
		
		$output=null;
		$retval=null;
		exec($sCommand, $output, $retval);
		echo "Returned with status $retval and output:\n";
		print_r($output);
		return $output;
	}
	
	public function write_to_file($sFilePath) {
		return file_exists($sFilePath);
	}
}

/*
opcodes vm memory stack parameters test
*/
?>