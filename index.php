<?php

require_once __DIR__ . '/vendor/autoload.php';

use PonderSource\GoogleApi\Google;
use PonderSource\HerokuApi\HerokuApiEndpoint;
use PonderSource\GitHubApi\GitHubClient;
use PonderSource\AWSApi\AWSClient;
use PonderSource\Library\DotEnv;

(new DotEnv(__DIR__ . '/.env'))->load();

$uri = $_SERVER['REQUEST_URI'];

// GOOGLE
//$google = new Google([
  //  'apiKey' => putenv('GOOGLE_APPLICATION_CREDENTIALS='.realpath("service-account-file.json"))
//]);
//var_dump($google->getCloudbillingSkus());

// HEROKU
// $her = new HerokuApiEndpoint;
// $her->getHerokuInvoice();

// GITHUB
$github = new GitHubClient('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');
$billing_info = $github->getUserActionsBilling("Triantafullenia-Doumani");
//var_dump($billing_info);

// $key = getenv('AWS_ACCESS_KEY_ID');
// $secret = getenv('AWS_SECRET_ACCESS_KEY');
//
// var_dump($key);
// $aws = new AWSClient([
//     'region'  => 'us-east-1',
//     'version' => 'latest',
//     'credentials' => [
//       'key' => $key,
//       'secret' => $secret
//     ],
//     'endpoint' => 'https://ce.us-east-1.amazonaws.com'
// ]);
// $aws->getCostAndUsage([
// 'Granularity' => 'DAILY', // REQUIRED
// 'Metrics' => ['BlendedCost'], // REQUIRED
// 'TimePeriod' => [ // REQUIRED
// 		'Start' => '2022-01-03', // REQUIRED
//     'End' => '2022-01-04', // REQUIRED
// 	],
// ],'aws_cost_and_usage');

?>
