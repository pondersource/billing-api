<?php

require_once __DIR__ . '/vendor/autoload.php';

use PonderSource\GoogleApi\Google;
use PonderSource\HerokuApi\HerokuApiEndpoint;

$uri = $_SERVER['REQUEST_URI'];

//$google = new Google([
  //  'apiKey' => putenv('GOOGLE_APPLICATION_CREDENTIALS='.realpath("service-account-file.json"))
//]);
//var_dump($google->getCloudbillingSkus());

$her = new HerokuApiEndpoint;
$her->getHerokuInvoice();
<<<<<<< HEAD
=======
// $google = new Google([
//     'apiKey' => putenv('GOOGLE_APPLICATION_CREDENTIALS='.realpath("service-account-file.json"))
// ]);
// var_dump($google->getCloudbillingSkus());
//
// $her = new HerokuApiEndpoint;
// $her->getUrlAccount($uri);
//
// $github = new GitHubClient();
// $github->getOrgBillingInfo("testORGbilling");

$key = getenv('AWS_ACCESS_KEY_ID');
$secret = getenv('AWS_SECRET_ACCESS_KEY');
>>>>>>> 3b7b5b53b1b3bb783683c4822fe7b38e34c19259

?>

