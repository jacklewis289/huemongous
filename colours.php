<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once("Models/LightData.php");


$view = new stdClass();
$view->pageTitle = 'Colours and Effects';

$lightData = new LightData();

require_once("Views/colours.phtml");
