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
var_dump($her->getHerokuInvoiceUBL());

$google = new Google([
    'apiKey' => putenv('GOOGLE_APPLICATION_CREDENTIALS='.realpath("service-account-file.json"))
]);
var_dump($google->getCloudbillingSkus());

$github = new GitHubClient();
$billing_info = $github->getOrgSharedStorageBilling("testORGbilling");
var_dump($billing_info);
$key = getenv('AWS_ACCESS_KEY_ID');
$secret = getenv('AWS_SECRET_ACCESS_KEY');

$aws = new AWSClient([
    'region'  => 'us-east-1',
    'version' => 'latest',
    'credentials' => [
      'key' => $key,
      'secret' => $secret
    ],
    'endpoint' => 'https://ce.us-east-1.amazonaws.com'
]);
$aws->getCostAndUsage([
'Granularity' => 'DAILY', // REQUIRED
'Metrics' => ['BlendedCost'], // REQUIRED
'TimePeriod' => [ // REQUIRED
		'Start' => '2022-01-03', // REQUIRED
    'End' => '2022-02-03', // REQUIRED
	],
],'aws_cost_and_usage');

?>
