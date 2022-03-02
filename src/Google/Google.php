<?php

namespace PonderSource\GoogleApi;

require 'vendor/autoload.php';
use Google\Cloud\Billing\V1\CloudBillingClient;

class Google {
    public function getCloudBillingInfo($url) {
    putenv('GOOGLE_APPLICATION_CREDENTIALS='.realpath("service-account-file.json"));
    $client = new CloudBillingClient();
    $myArray = [];
    switch($url) {
        case '/google/billingAccounts':
            $response = $client->getBillingAccount("billingAccounts/01C33A-8DD35D-FEEBB5");
            array_push($myArray, (object)[
                'billing_name' => $response->getName(),
                'display_billing_name' => $response->getDisplayName(),
                'billing_ouput' => $response->getOpen(),
            ]);
            echo '<pre>';
            var_dump($myArray);
            echo '</pre>';      
            file_put_contents('google_billing_accounts.json', json_encode($myArray, JSON_PRETTY_PRINT));
        break;
        case '/google/projects': 
            $response = $client->getProjectBillingInfo('projects/vast-descent-341509');

            array_push($myArray, (object)[
                'project_name' => $response->getName(),
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