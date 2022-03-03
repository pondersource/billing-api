<?php

namespace PonderSource\GoogleApi;

require 'vendor/autoload.php';
use Google\Cloud\Billing\V1\CloudBillingClient;
use Google\Cloud\Billing\V1\CloudCatalogClient;
use PonderSource\MissingApiKeyException;

class Google {
    //protected $apiKey;
    public function __construct(array $config) {
        foreach($config as $property => $value) {
            $this->$property = $value;
        }
    }

    /**
     * Lists the billing accounts that the current authenticated user has
     * Lists the projects associated with a billing account. The current
     * permission to
     * [view](https://cloud.google.com/billing/docs/how-to/billing-access).
     */
    public function getCloudBillingAccount() {
        $client = new CloudBillingClient();
        $myArray = [];
        try {
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

            file_put_contents('google_billing_accounts.json', json_encode($myArray, JSON_PRETTY_PRINT));
            return $myArray;

        } finally {
             $client->close();
        }
        
    }

    /**
     * Lists all public cloud services.
     */
    public function getCloudBillingServices() {
    //putenv('GOOGLE_APPLICATION_CREDENTIALS='.realpath("service-account-file.json"));
            $catalog = new CloudCatalogClient();
            $myArray = [];
            try {
            $response = $catalog->listServices();
            foreach ($response->iterateAllElements() as $services) {
                    array_push($myArray, [
                        "service_name" => $services->getName(),
                        "service_id" => $services->getServiceId(),
                        "display_name" => $services->getDisplayName(),
                        "business_entity_name" => $services->getBusinessEntityName()
                     ]);
                }

                file_put_contents('google_services.json', json_encode($myArray, JSON_PRETTY_PRINT));
                return $myArray;

            } finally {
                $catalog->close();
           }
           
       }

       /**
        * Lists all publicly available SKUs for a given cloud service.
        */
       public function getCloudbillingSkus() {
        $catalog = new CloudCatalogClient();
        $myArray = [];
        try {
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

            file_put_contents('google_skus.json', json_encode($myArray, JSON_PRETTY_PRINT));
            return $myArray;

        } finally {
            $catalog->close();
       }
       }
    }
   