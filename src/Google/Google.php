<?php

namespace PonderSource\GoogleApi;

require 'vendor/autoload.php';
use Google\Cloud\Billing\V1\CloudBillingClient;

class Google {
    public function getCloudBillingInfo($url) {
    putenv('GOOGLE_APPLICATION_CREDENTIALS='.realpath("service-account-file.json"));
    $client = new CloudBillingClient();

    switch($url) {
        case '/google/billingAccounts':
            $accounts = $client->listBillingAccounts();
          
            foreach ($accounts as $account) {
                print('Billing Accounts: ' . $account->getName() . PHP_EOL);
            }
        break;
        case '/google/projects': 
            $response = $client->getProjectBillingInfo('projects/vast-descent-341509');
            $myArray = [];

            array_push($myArray, (object)[
                'name' => $response->getName(),
                'project_id' => $response->getProjectId(),
                'billing_account_name' => $response->getBillingAccountName(),
            ]);
            echo '<pre>';
            var_dump($myArray);
            echo '</pre>';      
            file_put_contents('google_projects.json', json_encode($myArray, JSON_PRETTY_PRINT));   
       }
    }
   
}