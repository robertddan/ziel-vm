<?php
namespace App\Suiteziel\Opt;


use Twig\Loader\ArrayLoader;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

class Scan
{
	
	public function __construct () {

		# template
		$this->oTwig = new Environment(new FilesystemLoader(dirname(__DIR__) .'/Template/'), ['debug' => true]);
		$this->oTwig->addExtension(new \Twig\Extension\DebugExtension());
		print $this->oTwig->render('wallet.html.twig');
	}
	

}
?>