## Heroku API PHP Client

### Requirements
- PHP 7.3+ or 8.x

A PHP client for the Heroku Platform API working for Invoices, Account, Apps .etc

### Usage

* Checkout this repo
* Create a .env file in the repo root
* Comment/uncomment the service for which you want to retrieve invoices or usage info (Google, AWS, Github, Heroku).
* Run `composer install`
* Go to https://github.com/settings/tokens/new and create a personal access token. Tick 'admin:org' and 'user' as scopes.
* Save this in your `.env` file as:
```
GITHUB_ACCESS_TOKEN=ghp_0AwgbEb....
```
* Uncomment line 24 of src/index.php, and put in your Github username, for instance:
```
$user_billing = $github->getUserSharedStorageBilling("michielbdejong");
```
* Run `echo -n; heroku auth:token` to get a personal token for Heroku
* Save this in your `.env` file as:
```
HEROKU_API_KEY=30a84169-7c38-4b71-a19...
```
* First, run `var_dump($her->getUrlAccount('/heroku/teams'));` on line 31 of index.php to retrieve your Heroku teams information, then paste the team ID into the line `$team_invoices = $heroku->get("teams/a2516ec8-8e5e-48ae-b0cc-2051aab43893/invoices");`
which is hardcoded in HerokuApiEndpoint.php line 62.
* Run `php index.php`
* You will see something like:
```
array(3) { ["days_left_in_billing_cycle"]=> int(19) ["estimated_paid_storage_for_month"]=> int(0) ["estimated_storage_for_month"]=> int(0) }
```

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
### Methods

We can ask for billing information either for a user or organization

#### Organization

* getOrgSharedStorageBilling($org)
  - [Get GitHub Actions billing for an organization](https://docs.github.com/en/rest/reference/billing#get-github-actions-billing-for-an-organization)
* getOrgActionsBilling($org)
  - [Get GitHub Packages billing for an organization](https://docs.github.com/en/rest/reference/billing#get-github-packages-billing-for-an-organization)
* getOrgPackagesBillingInfo($org)
  - [Get shared storage billing for an organization](https://docs.github.com/en/rest/reference/billing#get-shared-storage-billing-for-an-organization)

##### User

* getUserSharedStorageBilling($user)
  - [Get GitHub Actions billing for a user](https://docs.github.com/en/rest/reference/billing#get-github-actions-billing-for-a-user)
* getUserActionsBilling($user)
  - [Get GitHub Packages billing for a user](https://docs.github.com/en/rest/reference/billing#get-github-packages-billing-for-a-user)
* getUserPackagesBillingInfo($user)
  - [Get shared storage billing for a user](https://docs.github.com/en/rest/reference/billing#get-shared-storage-billing-for-a-user)

#### Example

##### Get shared storage billing for an organization

At the `billing-api/index.php` first we need to create the GitHub Client

1) First we have to initialize the GitHub Client
```
$github = new GitHubClient();
```

2) Now we can choose between the 6 available functions and retrieve billing info(JSON) either for Organization or User.

```
$github->getOrgSharedStorageBilling("org");
```

3) Response

```
{
 "days_left_in_billing_cycle": 20,
 "estimated_paid_storage_for_month": 15,
 "estimated_storage_for_month": 40
}
```

# AWS API PHP Client

Namespace  `PonderSource\AWSApi`

* PHP library for communication with AWS services: [AWS SDK](https://aws.amazon.com/sdk-for-php/).

* Cost Explorer API endpoint: `https://ce.us-east-1.amazonaws.com`.

### Credentials

From `~/.aws/credentials.ini` we can retireve the credentials

* AWS_ACCESS_KEY_ID

* AWS_SECRET_ACCESS_KEY

#### Using temporary security credentials with the AWS CLI

 `aws sts get-session-token --serial-number arn-of-the-mfa-device --token-code code-from-token`

### [Root Access Keys VS IAM Access Keys](https://docs.aws.amazon.com/general/latest/gr/root-vs-iam.html)

 * Root access
   - Allow full access to all resources in the account

 * IAM Access Keys
   -  Access to AWS services and resources for users in your AWS account

### Example

1) At the `billing-api/index.php` first we need to create AWS Client

```
$aws = new AWSClient([
    'region'  => 'us-east-1',
    'version' => 'latest',
    'credentials' => [
      'key' => $key,
      'secret' => $secret
    ],
    'endpoint' => 'https://ce.us-east-1.amazonaws.com'
]);

```
2) Now we can get Cost and Usage report. Please consider, that the User have to enable the Cost Explorer first(It may take some time to ingest the data)

```

$aws->getCostAndUsage([
'Granularity' => 'DAILY', // REQUIRED
'Metrics' => ['BlendedCost'], // REQUIRED
'TimePeriod' => [ // REQUIRED
		'Start' => '2022-01-03', // REQUIRED
    'End' => '2022-02-03', // REQUIRED
	],
],'aws_cost_and_usage');
```
