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
            foreach ($response->iterateAllElements() as $services) {
                    array_push($myArray, [
                        "service_name" => $services->getName(),
                        "service_id" => $services->getServiceId(),
                        "display_name" => $services->getDisplayName(),
                        "business_entity_name" => $services->getBusinessEntityName()
                     ]);
                }
            echo '<pre>';
            var_dump($myArray);
            echo '</pre>';      
            file_put_contents('google_services.json', json_encode($myArray, JSON_PRETTY_PRINT));
        case "/google/skus":
            $result = $catalog->listSkus("services/0069-3716-5463");
            foreach ($result->iterateAllElements() as $listSkus) {
                array_push($myArray, [
                    "sku_name" => $listSkus->getName(),
                    "sku_id" => $listSkus->getSkuId(),
                    "sku_description" => $listSkus->getDescription(),
                    "sku_provider_name" => $listSkus->getServiceProviderName(),
                    "sku_service_name" =>  $listSkus->getCategory()->getServiceDisplayName(),
                    "sku_resource" => $listSkus->getCategory()->getResourceFamily(),
                    "sku_group" => $listSkus->getCategory()->getResourceGroup(),
                    "sku_usage_type" => $listSkus->getCategory()->getUsageType(),
                ]);
            }
            echo '<pre>';
            var_dump($myArray);
            echo '</pre>';      
            file_put_contents('google_skus.json', json_encode($myArray, JSON_PRETTY_PRINT));
       }
    }
   
}