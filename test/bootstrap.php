<?php
require_once("./vendor/autoload.php");
require_once __DIR__.'/Mahout/TestCase.php';

spl_autoload_register(function($class)
{
    $file = __DIR__.'/../src/'.strtr($class, '\\', '/').'.php';
    if (file_exists($file)) {
        require $file;
        return true;
    }
});


function debug($mixed){
	echo "<pre>";
	print_r($mixed);
	echo "</pre>";
}