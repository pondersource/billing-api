<?php

namespace PonderSource\GitHubApi;

use Sabre\Xml\Service;
use PonderSource\InvoiceResponse\Invoice;
use PonderSource\InvoiceResponse\Invoices;

class DeserializeInvoice
{
    public function deserializeInvoice($outputXMLString) {
        $service = new Service();
        $service->elementMap = [
            '{http://example.org/invoices}invoices' => function(\Sabre\Xml\Reader $reader) {
                $invoices = new Invoices();
                $children = $reader->parseInnerTree();
                foreach($children as $child) {
                    if ($child['value'] instanceof Invoices) {
                        $books->books[] = $child['value'];
                    }
                }
                return $invoices;
            },
            '{http://example.org/invoices}invoice' => function(\Sabre\Xml\Reader $reader) {
                $invoice = new Invoice();
                // Borrowing a parser from the KeyValue class.
                $keyValue = \Sabre\Xml\Deserializer\keyValue($reader, 'http://example.org/invoices');

                if (isset($keyValue['total_minutes_used'])) {
                    $invoice->total_minutes_used = $keyValue['total_minutes_used'];
                }
                if (isset($keyValue['total_paid_minutes_used'])) {
                    $invoice->total_paid_minutes_used = $keyValue['total_paid_minutes_used'];
                }
                if (isset($keyValue['included_minutes'])) {
                    $invoice->included_minutes = $keyValue['included_minutes'];
                }
                if (isset($keyValue['minutes_used_breakdown'])) {
                    $invoice->minutes_used_breakdown = $keyValue['minutes_used_breakdown'];
                }
                return $invoice;
            },
        ];
        return  $service->parse($outputXMLString);
    }
}
