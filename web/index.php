<?php

require_once __DIR__ . '/vendor/autoload.php';

use PonderSource\GoogleApi\Google;
use PonderSource\HerokuApi\HerokuApiEndpoint;

$uri = $_SERVER['REQUEST_URI'];

$google = new Google([
    'apiKey' => putenv('GOOGLE_APPLICATION_CREDENTIALS='.realpath("service-account-file.json"))
]);
var_dump($google->getCloudbillingSkus());

$her = new HerokuApiEndpoint;
$her->getUrlAccount($uri);

?>
