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

1) First we have to initialize the GitHub Client
```
$github = new GitHubClient();
```

2) Now we can choose between the 6 available functions and retrieve billing info(JSON) either for Organization or User.

```
$github->getOrgSharedStorageBilling("org");
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

 aws sts get-session-token --serial-number arn-of-the-mfa-device --token-code code-from-token

### [Root Access Keys VS IAM Access Keys](https://docs.aws.amazon.com/general/latest/gr/root-vs-iam.html)

 * Root access
   - Allow full access to all resources in the account

 * IAM Access Keys
   -  Access to AWS services and resources for users in your AWS account

### Example

1) First we have to create the AWS Client

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
2) Now we can get Cost and Usage report.(Please note that the User have to enable the Cost Explorer first(It may take some time to ingest the data)

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
