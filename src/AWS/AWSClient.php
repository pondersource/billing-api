<?php

namespace PonderSource\AWSApi;

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use Aws\Exception\AwsException;
use Aws\CostExplorer\CostExplorerClient;
use Aws\CostExplorer\Exception;

class AWSClient{

	protected $s3;

	public function __construct(){

		// Get credentials from env
		// $key = getenv('AWS_ACCESS_KEY_ID');
		// $secret = getenv('AWS_SECRET_ACCESS_KEY');

		$key = 'acces_key';
		$secret = 'secret_acces_key';

		$credentials = [
			'key' => $key,
			'secret' => $secret
		];
		var_dump("Get AWS Cost and Usage: ");
		$config = [
		    'region'  => 'us-east-1',
		    'version' => 'latest',
				'credentials' => $credentials,
				'endpoint' => 'https://ce.us-east-1.amazonaws.com'
		];
		// Create a CostExplorerClient
		$this->s3 = new CostExplorerClient($config);
	}

	public function getCostAndUsage($params,$filename){

		$cost_and_usage = $this->s3->getCostAndUsage($params);
		echo '<pre>';
		var_dump($cost_and_usage);
		echo '</pre>';
		file_put_contents($filename, json_encode($cost_and_usage, JSON_PRETTY_PRINT));
		return $cost_and_usage;
	}
}

?>
