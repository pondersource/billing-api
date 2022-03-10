<?php

namespace PonderSource\InvoiceResponse;

use Sabre\Xml\XmlSerializable;
use Sabre\Xml\Writer;

class Invoice implements XmlSerializable {
    public $charges_total;
    public $created_at;
    public $credits_total;
    public $id;
    public $number;
    public $period_start;
    public $period_end;
    public $state;
    public $total;
    public $updated_at;

    function xmlSerialize(Writer $writer) {
        $ns = '{http://example.org/invoices}';

        $writer->write([
            $ns . 'charges_total' => $this->charges_total,
            $ns . 'created_at' => $this->created_at,
            $ns . 'credits_total' => $this->credits_total,
            $ns . 'id' => $this->id,
            $ns . 'number' => $this->number,
            $ns . 'period_start' => $this->period_start,
            $ns . 'period_end' => $this->period_end,
            $ns . 'state' => $this->state,
            $ns . 'total' => $this->total,
            $ns . 'updated_at' => $this->updated_at,
        ]);

    }
}
