<?php

namespace PonderSource\GitHubApi;

use Sabre\Xml\Service;
use PonderSource\GitHubApi\Invoice;
use PonderSource\InvoiceResponse\Invoices;

class GenerateInvoice
{
    public static function invoice(Invoice $invoice)
    {
        $xmlService = new Service();

        return $xmlService->write('{http://example.org/invoices}invoice', [
            $invoice
        ]);
    }
}
