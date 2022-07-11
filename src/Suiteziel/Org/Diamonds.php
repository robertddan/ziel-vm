<?php
namespace App\Suiteziel\Org;


class Diamonds
{
	
	public $sFilePathOutput;
	public $sHex;
	public $iCursor;
	public $sFolder;
		
	public function __construct() {
		$this->sFilePathOutput = "./src/diamonds/". date("YmdHisu") ."/";
		$this->iCursor = 0;
	}

	public function set_output_folder() :bool {
		if (!empty($this->sFolder)) $this->sFilePathOutput = "./src/diamonds/". $this->sFolder ."/";
		return true;
	}

	public function compile_contract($sFilename = null) :bool {
		if(empty($sFilename)) return print '$sFilename missing!'. PHP_EOL;
		if ($this->iCursor === 1) return false;
		
		$sFilePath = __APP__ .'contracts/'. $sFilename;
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
echo '<pre>';

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
}

/*
opcodes vm memory stack parameters test
*/
?>