<?php

namespace PonderSource\GoogleApi;

require 'vendor/autoload.php';
use Google\Cloud\Billing\V1\CloudBillingClient;
use Google\Cloud\Billing\V1\CloudCatalogClient;

class Google {
    public function getCloudBillingInfo($url) {
    putenv('GOOGLE_APPLICATION_CREDENTIALS='.realpath("service-account-file.json"));
    $client = new CloudBillingClient();
    $catalog = new CloudCatalogClient();
    $myArray = [];
    switch($url) {
        case '/google/billingAccounts':
            $response = $client->listBillingAccounts();
            foreach ($response->iterateAllElements() as $element) {
                $result = $client->listProjectBillingInfo($element->getName());
                foreach($result->iterateAllElements() as $project) {
                    array_push($myArray, (object)[
                        'project_name' => $project->getName(),
                        'project_id' => $project->getProjectId(),
                        'billing_account_name' => $project->getBillingAccountName(),
                        'display_billing_name' => $element->getDisplayName(),
                        'billing_ouput' => $element->getOpen(),
                    ]);
                }
            }
            echo '<pre>';
            var_dump($myArray);
            echo '</pre>';      
            file_put_contents('google_billing_accounts.json', json_encode($myArray, JSON_PRETTY_PRINT));
        break;
         
         case "/google/services":
            $response = $catalog->listServices();
            foreach ($response->iterateAllElements() as $element) {
                array_push($myArray, [
                   'service_name' => $element->getName(),
                   'service_id' => $element->getServiceId(),
                   "display_name" => $element->getDisplayName(),
                   "business_entity_name" => $element->getBusinessEntityName()
                ]);
            }
            echo '<pre>';
            var_dump($myArray);
            echo '</pre>';      
            file_put_contents('google_services.json', json_encode($myArray, JSON_PRETTY_PRINT));
        
       }
    }
   
}