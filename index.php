<?php

require_once __DIR__ . '/vendor/autoload.php';

use PonderSource\HerokuApi\HerokuApiEndpoint;
$uri = $_SERVER['REQUEST_URI'];

$her = new HerokuApiEndpoint;
$her->getUrlAccount($uri);

?>

