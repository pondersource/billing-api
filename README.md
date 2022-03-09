### PHP library to get billing information from Heroku, GitHub, AWS, Google.

Implementation in progress.

## Heroku API PHP Client

### Requirements
- PHP 7.3+ or 8.x

A PHP client for the Heroku Platform API working for Invoices, Account, Apps .etc

### Usage

For example you need to get information for get invoice from API heroku you need to use this.

````php
use Ishifoev\HerokuApi\HerokuClient;

$heroku = new HerokuClient([
   'apiKey' => 'YOUR_API_HERE',
]);
$invoice = $heroku->get('account/invoices');

echo '<pre>';
var_export($invoice);
echo '</pre>';
file_put_contents("invoice.json", json_encode($invoice, JSON_PRETTY_PRINT));
````

# GitHub API PHP Client

Namespace  `PonderSource\GitHubApi`

### Authorization

We need to provide the user's TOKEN(We recommend to use TOKENS with expiration date)

### Headers

Recuired Headers to call the GitHub API endpoints:

```
    "User-Agent: Example REST API Client",
    "Accept: application/vnd.github.v3+json",
    "Authorization: token TOKEN"
```

### How to use

From the `billing-api/index.php` we need to create the GitHub Client

```
$github = new GitHubClient();

```

We can ask for billing information for a user or organization
### Methods

#### Organization

* getOrgSharedStorageBilling($org)
* getOrgActionsBilling($org)
* getOrgPackagesBillingInfo($org)

#### GitHub billing API for organizations

* [Get GitHub Actions billing for an organization](https://docs.github.com/en/rest/reference/billing#get-github-actions-billing-for-an-organization)
* [Get GitHub Packages billing for an organization](https://docs.github.com/en/rest/reference/billing#get-github-packages-billing-for-an-organization)
* [Get shared storage billing for an organization](https://docs.github.com/en/rest/reference/billing#get-shared-storage-billing-for-an-organization)


##### User

* getUserSharedStorageBilling($user)
* getUserActionsBilling($user)
* getUserPackagesBillingInfo($user)

#### GitHub billing API for users

* [Get GitHub Actions billing for a user](https://docs.github.com/en/rest/reference/billing#get-github-actions-billing-for-a-user)
* [Get GitHub Packages billing for a user](https://docs.github.com/en/rest/reference/billing#get-github-packages-billing-for-a-user)
* [Get shared storage billing for a user](https://docs.github.com/en/rest/reference/billing#get-shared-storage-billing-for-a-user)


#### Example

Get shared storage billing for an organization

```
$github = new GitHubClient();
$github->getOrgSharedStorageBilling("org");
```

# AWS API PHP Client

Namespace  `PonderSource\AWSApi`

We are using the [AWS SDK](https://aws.amazon.com/sdk-for-php/). The endpoint we need for that is the `https://ce.us-east-1.amazonaws.com`.

### Credentials

 The SDK should detect the credentials from environment variables (via AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY), an AWS credentials INI file in your HOME directory, AWS Identity and Access Management (IAM) instance profile credentials, or credential providers.

#### Using temporary security credentials with the AWS CLI

 aws sts get-session-token --serial-number arn-of-the-mfa-device --token-code code-from-token

 #### Example

```
 $aws = new AWSClient();
 $aws->getCostAndUsage($params,'aws_cost_and_usage');
```
