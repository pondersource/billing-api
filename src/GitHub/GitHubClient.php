<?php

// https://docs.github.com/en/rest/reference/billing
namespace PonderSource\GitHubApi;

use PonderSource\GitHubApi\Invoice;
use PonderSource\GitHubApi\GenerateInvoice;

class GitHubClient{

	const BASE_URL = "https://api.github.com";
	private $token;

	public function __construct($token) {
			$this->$token = $token;
	}

	public function callGitHubEndpoint($url){
		$headers = [
		    "User-Agent: Example REST API Client",
				"Accept: application/vnd.github.v3+json",
		    "Authorization: token "."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"
		];

		$ch = curl_init();

		curl_setopt_array($ch, [
		    CURLOPT_HTTPHEADER => $headers,
		    CURLOPT_RETURNTRANSFER => true
		]);

		curl_setopt($ch, CURLOPT_URL, $url);

		$response = curl_exec($ch);

		curl_close($ch);

		$data = json_decode($response, true);
		return $data;
	}

	// https://api.github.com/orgs/ORG/settings/billing/shared-storage
	public function getOrgSharedStorageBilling($organization){
		$url = self::BASE_URL."/orgs/".$organization."/settings/billing/";
		$shared_storage = $this->callGitHubEndpoint($url."shared-storage");
		return $shared_storage;
	}

	// https://api.github.com/orgs/ORG/settings/billing/actions
	public function getOrgActionsBilling($organization){
		$url = self::BASE_URL."/orgs/".$organization."/settings/billing/";
		$actions = $this->callGitHubEndpoint($url."actions");
		return $actions;
	}

	// https://api.github.com/orgs/ORG/settings/billing/packages
	public function getOrgPackagesBillingInfo($organization){
		$url = self::BASE_URL."/orgs/".$organization."/settings/billing/";
		$packages = $this->callGitHubEndpoint($url."packages");
		return $packages;
	}

	// https://api.github.com/users/USERNAME/settings/billing/shared-storage
	public function getUserSharedStorageBilling($username){
		$url = self::BASE_URL."/users/".$username."/settings/billing/";
		$shared_storage = $this->callGitHubEndpoint($url."shared-storage");
		return $shared_storage;
	}

	// https://api.github.com/users/USERNAME/settings/billing/actions
	public function getUserActionsBilling($username){
		$url = self::BASE_URL."/users/".$username."/settings/billing/";
		$actions = $this->callGitHubEndpoint($url."actions");
		$this->getGitHubInvoice($actions,'github_invoice.json');
		//$this->deserializeGitHubInvoice(json_encode($actions, JSON_PRETTY_PRINT));
	}

	// https://api.github.com/users/USERNAME/settings/billing/packages
	public function getUserPackagesBillingInfo($username){
		$url = self::BASE_URL."/users/".$username."/settings/billing/";
		$packages = $this->callGitHubEndpoint($url."packages");
		return $packages;
	}


	public function getGitHubInvoice($response,$JSONfilename){
			$invoice = new Invoice();
		//	foreach($response as $res) {
				$invoice->total_minutes_used = $response["total_minutes_used"];
				$invoice->total_paid_minutes_used = $response["total_paid_minutes_used"];
				$invoice->included_minutes = $response["included_minutes"];
				$invoice->minutes_used_breakdown = $response["minutes_used_breakdown"];

				//var_dump($invoice);
			//	var_dump($res);
				$generateInvoice = new GenerateInvoice();
				$outputXMLString = $generateInvoice->invoice($invoice);

				$dom = new \DOMDocument;
				$dom->loadXML($outputXMLString);
				$dom->save('github_billing.xml');

				file_put_contents($JSONfilename, json_encode($response, JSON_PRETTY_PRINT));
		//	}
			return $invoice;
	}
	public function deserializeGitHubInvoice($outputXMLString) {
			$deserializeInvoice = new DeserializeInvoice();
			$deserialize = $deserializeInvoice->deserializeInvoice($outputXMLString);
	}
}
?>
