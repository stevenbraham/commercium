<?php
/**
 * Created by PhpStorm.
 * User: stevenbraham
 * Date: 27-03-17
 * Time: 13:14
 */
error_reporting(E_ALL);
ini_set('display_errors', '1');

use framework\Setup;

session_start();
//load composer libraries
require_once "vendor/autoload.php";
//boot framework
require_once "framework/Setup.php";
$framework = Setup::boot();
var_dump($framework->repositories->users->all());
var_dump($framework->repositories->users->findOrFail(1));