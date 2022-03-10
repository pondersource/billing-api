<?php

namespace PonderSource\InvoiceResponse;

use Sabre\Xml\Service;
use PonderSource\InvoiceResponse\Invoice;
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
