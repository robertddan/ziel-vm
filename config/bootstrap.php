<?php

require __DIR__ .'/../vendor/autoload.php';


define("__APP__", __DIR__ .'/../src/');

var_dump(file_exists(__APP__. 'index.html'));
?>