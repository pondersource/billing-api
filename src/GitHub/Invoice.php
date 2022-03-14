<?php

namespace PonderSource\GitHubApi;

use Sabre\Xml\XmlSerializable;
use Sabre\Xml\Writer;

class Invoice implements XmlSerializable {
    public $total_minutes_used;
    public $total_paid_minutes_used;
    public $included_minutes;
    public $minutes_used_breakdown;

    function xmlSerialize(Writer $writer) {
        $ns = '{http://example.org/invoices}';

        $writer->write([
            $ns . 'total_minutes_used' => $this->total_minutes_used,
            $ns . 'total_paid_minutes_used' => $this->total_paid_minutes_used,
            $ns . 'included_minutes' => $this->included_minutes,
            $ns . 'minutes_used_breakdown' => $this->minutes_used_breakdown,
        ]);

        return $ns;
    }
}
