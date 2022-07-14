<?php
namespace App\Suiteziel\Org;


class Diamonds
{
	
	public $sFilePathOutput;
	public $aHex;
	public $sHex;
	public $iCursor;
	public $sFolder;
	public $sContract;
		
	public function __construct() {
		$this->sFilePathOutput = "./src/diamonds/". date("YmdHisu") ."/";
		$this->iCursor = 0;
	}

	public function set_output_folder() :bool {
		if (empty($this->sFolder)) return false;
		$this->sFilePathOutput = "./src/diamonds/". $this->sFolder ."/";
		return true;
	}

	public function compile_contract() :bool {
		if(empty($this->sContract)) return false; //print '$sFilename missing!'. PHP_EOL;
		if ($this->iCursor === 1) return true;
		
		$sFilePath = __APP__ .'contracts/'. $this->sContract;
		$sCommand = 'solc --bin-runtime --overwrite --asm --optimize -o '. $this->sFilePathOutput .' '.$sFilePath;
		
		$output=null;
		$retval=null;
		exec($sCommand, $output, $retval);
		print_r($output);
		$this->iCursor = 1;
		return true;
	}
	
	public function read_from_file() :bool {
		//if(empty($sFilePath)) return print '$sFilePath missing!';
		//else $this->$sFilePath = $sFilePath;

		if ($this->iCursor !== 1) return false;

		
		$aFilesOutput = scandir($this->sFilePathOutput);
		$sContractName = null;
	
		foreach ($aFilesOutput as $sFileOutput) {
			preg_match("/(\w)*bin-runtime\b/", $sFileOutput, $aMatches);
			$sContractName = $sFileOutput;
			if(!empty($aMatches)) break;
		}
		$this->sHex = file_get_contents($this->sFilePathOutput."/". $sContractName);
		
		return true;
	}
	
	public function write_to_file($sFilePath) {
		return file_exists($sFilePath);
	}
	
	public function decode_hex () :bool {
		$this->aHex = str_split($this->sHex, 2);
		return true;
	}
	
	public function hex_base_convert ($sHex): int {
		return base_convert($sHex, 16, 10);
	}

}

/*
opcodes vm memory stack parameters test
*/
?>