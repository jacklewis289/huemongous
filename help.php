<?php
require_once __DIR__ . '/vendor/autoload.php';


$view = new stdClass();
$view->pageTitle = 'Help';


require_once("Views/help.phtml");
