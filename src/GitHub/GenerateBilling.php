<?php

namespace PonderSource\GitHubApi;

use Sabre\Xml\Service;
use PonderSource\GitHubApi\Invoice;
use PonderSource\InvoiceResponse\Invoices;

class GenerateInvoice
{
    public static function billing(Invoice $billing)
    {
        $xmlService = new Service();

        return $xmlService->write('{http://example.org/billings}billing', [
            $billing
        ]);
    }
}
