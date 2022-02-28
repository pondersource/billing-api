<?php

namespace PonderSource\GoogleApi;

require 'vendor/autoload.php';
use Google\Cloud\Billing\V1\CloudBillingClient;

class Google {
    public function getClient() {
    putenv('GOOGLE_APPLICATION_CREDENTIALS='.realpath("service-account-file.json"));

    $client = new CloudBillingClient();
    $accounts = $client->listBillingAccounts();

    foreach ($accounts as $account) {
        print('Billing account: ' . $account->getName() . PHP_EOL);
    }
   
    }
   
}