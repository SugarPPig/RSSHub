<?php
include "vendor/autoload.php";
include "PDOController.php";
include "SpiderController.php";
include "function.php";

ini_set("display_errors","On");
error_reporting(E_ALL);
set_time_limit(0);

$route = $_REQUEST['route']??'source/index';

$pdo = new PDOController();
$spider = new SpiderController();

switch ($route){
    case 'source/index':
        $spider->source();
        break;
    case 'rss/add':
        $pdo::add();
        break;
    case 'rss/detail':
        $pdo::detail();
        break;
    case 'rss/route':
        $pdo::route();
        break;
//    case 'rss/list':
//        $pdo::list();
//        break;
    default:
        die('fail');
        break;
}