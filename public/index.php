<?php
use hyperion\core\Bootstrap;

session_start();

error_reporting(E_ERROR | E_WARNING | E_PARSE);
// error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
date_default_timezone_set("Europe/Stockholm");

include_once dirname(__DIR__)."/vendor/autoload.php";
include_once dirname(__DIR__)."/library/config.php";

$Bootstrap = new Bootstrap();
