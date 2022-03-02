<?php

// https://docs.github.com/en/rest/reference/billing
namespace PonderSource\GitHubApi;

use GitHubEndpoint;

class GitHubClient{

	const BASE_URL = "https://api.github.com";

	public function callGitHubEndpoint($url){
		$headers = [
		    "User-Agent: Example REST API Client",
				"Accept: application/vnd.github.v3+json",
		    "Authorization: token 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"
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
	public function getOrgSharedStorageBilling($username){
		$url = self::BASE_URL."/users/".$username."/settings/billing/";
		$shared_storage = $this->callGitHubEndpoint($url."shared-storage");
		return $shared_storage;
	}

	// https://api.github.com/users/USERNAME/settings/billing/actions
	public function getOrgActionsBilling($username){
		$url = self::BASE_URL."/users/".$username."/settings/billing/";
		$actions = $this->callGitHubEndpoint($url."actions");
		return $actions;
	}

	// https://api.github.com/users/USERNAME/settings/billing/packages
	public function getOrgPackagesBillingInfo($username){
		$url = self::BASE_URL."/users/".$username."/settings/billing/";
		$packages = $this->callGitHubEndpoint($url."packages");
		return $packages;
	}
}
?>
