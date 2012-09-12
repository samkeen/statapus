<?php
namespace Statapus;

/**
 * @return App
 */
session_start();
require __DIR__ . "/autoload.php";
$config = require __DIR__ . "/conf/conf.php";
$db = new Db($config['db']);
unset($config['db']);
$app = new App($config, $db);
$app->init();
return $app;

function h($string, $echo=true)
{
    $string = htmlentities($string, ENT_QUOTES, 'UTF-8');
    if($echo)
    {
        echo($string);
    }
    else
    {
        return $string;
    }
}