<?php

require_once __DIR__ . '/vendor/autoload.php';

use PonderSource\GoogleApi\Google;
use PonderSource\HerokuApi\HerokuApiEndpoint;

$uri = $_SERVER['REQUEST_URI'];

$google = new Google();
$google->getCloudBillingInfo($uri);

$her = new HerokuApiEndpoint;
$her->getUrlAccount($uri);

?>

