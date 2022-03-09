<?php

require_once __DIR__ . '/vendor/autoload.php';

use PonderSource\GoogleApi\Google;
use PonderSource\HerokuApi\HerokuApiEndpoint;
use PonderSource\GitHubApi\GitHubClient;
use PonderSource\AWSApi\AWSClient;

$uri = $_SERVER['REQUEST_URI'];

$google = new Google([
    'apiKey' => putenv('GOOGLE_APPLICATION_CREDENTIALS='.realpath("service-account-file.json"))
]);
var_dump($google->getCloudbillingSkus());

$her = new HerokuApiEndpoint;
$her->getUrlAccount($uri);

$github = new GitHubClient();
$github->getOrgBillingInfo("testORGbilling");

$params = [
'Granularity' => 'DAILY', // REQUIRED
'Metrics' => ['BlendedCost'], // REQUIRED
'TimePeriod' => [ // REQUIRED
		'End' => '2022-08-03', // REQUIRED
		'Start' => '2022-07-03', // REQUIRED
	],
];

$aws = new AWSClient();
$aws->getCostAndUsage($params,'aws_cost_and_usage');
?>
