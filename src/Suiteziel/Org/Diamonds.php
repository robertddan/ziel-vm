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
		#$this->iCursor = 1;
	}
	
	public function set_input_contract() :bool {
		if (empty($this->sContract)) return false;
    print_r(['set_input_contract()','file_exists:',file_exists(__SRC__ ."contracts/". $this->sContract .".sol")]);
		$this->sContractPath = __SRC__ ."contracts/". $this->sContract .".sol";
		return true;
	}
	
	public function set_output_folder() :bool {
		if (empty($this->sFolder)) return false;
		$this->sOutput = __SRC__ ."diamonds/". $this->sFolder ."/";
		return true;
	}
	
	public function compile_contract() :bool {
    print_r(['compile_contract()', 'sContract:', $this->sContract .".sol", 'iCursor:', $this->iCursor]);
		if (empty($this->sContract)) return false; //print '$sFilename missing!'. PHP_EOL;
		#if ($this->iCursor === 0) return true;
		if (!file_exists($this->sOutput)) mkdir($this->sOutput);
		
		#$sCommand = 'solc --bin-runtime --overwrite --asm --optimize -o '. $this->sContractPath .' '.$this->sOutput;
		$sCommand = 'solc --evm-version "homestead" --bin '. $this->sContractPath 
			.' --optimize --optimize-runs 200 -o '. $this->sOutput;
		
		$sOutput = $sRetval = null;
		$sArgs = array();
		$bExec = exec($sCommand, $sOutput, $sRetval);
		#$bExec = system($sCommand, $sOutput);
		#$bExec = pcntl_exec($sCommand, $sArgs);
		print_r(['compile_contract()', 'sCommand:',$sCommand, '$bExec', $bExec, 'sOutput:', $sOutput, '$sRetval', $sRetval]);
		sleep(2);
		var_dump($this->sOutput);
		if (file_exists($this->sOutput)) $this->iCursor = 0;
		return true;
	}

	public function read_from_file() :bool {
		#if ($this->iCursor == 1) return false;
		$sContractName = $this->sContract .".bin";
		$this->sHex = file_get_contents($this->sOutput ."/". $sContractName);
		
		return true;
	}
	
	public function split_hex () :bool {
		$this->aHex = str_split($this->sHex, 2);
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