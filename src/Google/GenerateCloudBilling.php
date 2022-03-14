<?php

namespace PonderSource\GoogleApi;

use Sabre\Xml\Service;
use PonderSource\HerokuApi\CloudBilling;
use PonderSource\HerokuApi\CloudBillings;

class GenerateCloudBilling
{
    public static function billing(CloudBilling $billing)
    {
        $xmlService = new Service();

        return $xmlService->write('{http://example.org/billings}billing', [
            $billing
        ]);
    }
}