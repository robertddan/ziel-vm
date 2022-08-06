<?php
namespace App\Suiteziel\Org;


class Diamonds
{
	
	public $iCursor;
	public $sFolder;
	public $sOutput;
	
	public $sContract;
	public $sContractPath;
	
	public static $_aHex;
	public $aHex;
	public $sHex;
	
	public function __construct() {
		define("__SUITEZIEL__", dirname( __DIR__ .'../'));
		define("__SRC__", __SUITEZIEL__ .'/../');
		
		$this->sFolder = date("YmdHisu");
		$this->sOutput = __SRC__ ."diamonds/". $this->sFolder ."/";
		//$this->sOutput = dirname(__SRC__ ."/diamonds/". date("YmdHisu") ."/");
		$this->iCursor = 0;
	}
	
	public function set_input_contract() :bool {
		if (empty($this->sContract)) return false;
		$this->sContractPath = __SRC__ ."contracts/". $this->sContract;
		return true;
	}
	
	public function set_output_folder() :bool {
		if (empty($this->sFolder)) return false;
		$this->sOutput = __SRC__ ."diamonds/". $this->sFolder ."/";
		return mkdir($this->sOutput);
		//return true;
	}
	
	public function compile_contract() :bool {
		if (empty($this->sContract)) return false; //print '$sFilename missing!'. PHP_EOL;
		if ($this->iCursor === 1) return true;

		//$sCommand = 'solc --bin-runtime --overwrite --asm --optimize -o '. $this->$sOutput .' '.$sFilePath;
		$sCommand = 'solc --evm-version "homestead" --bin '. $this->sContractPath .' --optimize --optimize-runs 200 -o '. $this->sOutput;
			
		$output=null;
		$retval=null;
		$bExec = exec($sCommand, $output, $retval);
		print_r($output);
		sleep(2);
		$this->iCursor = 1;
		return true;
	}

	public function read_from_file() :bool {
		if ($this->iCursor !== 1) return false;

		$aFilesOutput = scandir($this->sOutput);
		$sContractName = null;

		foreach ($aFilesOutput as $sFileOutput) {
			//preg_match("/(\w)*bin-runtime\b/", $sFileOutput, $aMatches);
			preg_match("/(\w)*.bin\b/", $sFileOutput, $aMatches);
			$sContractName = $sFileOutput;
			if(!empty($aMatches)) break;
		}
		$this->sHex = file_get_contents($this->sOutput ."/". $sContractName);
		
		return true;
	}
	
	public function decode_hex () :bool {
		$aHex = str_split($this->sHex, 2);
		$this->aHex = self::$_aHex = array_map(function($sHex) {
			$sHex = base_convert($sHex, 16, 10);
			if ($sHex == 0) $sHex = '00';
			return $sHex;
		}, $aHex);

		return true;
	}

}

?>