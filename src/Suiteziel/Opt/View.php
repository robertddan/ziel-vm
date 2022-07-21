<?php
namespace App\Suiteziel\Opt;

class View
{
	public function __construct() {
		
		$this->aUri = array_filter(explode('/', $_SERVER['REQUEST_URI']));
		if ($this->aUri[1] == "favicon.ico") {
			header('Content-Type: image/x-icon');
			return print file_get_contents('/workspace/action/draft/www/public/favicon.ico');
		}
		elseif ($this->aUri[3] == 'assets') {
		else {
			header('Content-Type: text/html; charset=UTF-8');
			// $this->aUri = must add GET parameters to send in the contraoller
			// FIX URI shortcut
			var_dump($this->aUri);

			$sNamespace = implode("\\", array(
			"App",
			"Suiteziel",
			"Opt",
			"Scan"
			//ucfirst($this->aUri[1]),
			//ucfirst($this->aUri[2]),
			//"View\View_".
			//lcfirst($this->aUri[2])
			));
			/*var_dump(array(
			$sNamespace,
			class_exists($sNamespace)							
			));*/
			if (!class_exists($sNamespace)) exit($sNamespace . ' in: <b>'. __FILE__ .'</b>');
			$oNamespace = new $sNamespace($this->aUri);
			$sViewFunction = $this->aUri[3];
			return $oNamespace->$sViewFunction();
		}
  }
}

?>