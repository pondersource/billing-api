<?php

require_once __DIR__ . '/vendor/autoload.php';

use PonderSource\GoogleApi\Google;
use PonderSource\HerokuApi\HerokuApiEndpoint;

$google = new Google();
$google->getClient();


$uri = $_SERVER['REQUEST_URI'];

$her = new HerokuApiEndpoint;
$her->getUrlAccount($uri);

?>

