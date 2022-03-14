<?php

namespace PonderSource\HerokuApi;

use Sabre\Xml\XmlSerializable;
use Sabre\Xml\Writer;

class Invoice implements XmlSerializable {
    private $charges_total;
    private $created_at;
    private $credits_total;
    private $id;
    private $number;
    private $period_start;
    private $period_end;
    private $state;
    private $total;
    private $updated_at;

    /**
     * unique identifier of this invoice
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * total charges on this invoice
     * example: 100.00
     */
    public function setChargeTotal($charges_total) {
        $this->charges_total = $charges_total;
        return $this;
    }

    /**
     *  when invoice was created
     */
    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * total credits on this invoice
     */
    public function setCreditsTotal($credits_total) {
        $this->credits_total = $credits_total;
        return $this;
    }

    /**
     * human readable invoice number
     */
    public function setNumber($number) {
        $this->number = $number;
        return $this;
    }

    /**
     *  the starting date that this invoice covers
     */
    public function setPeriodStart($period_start) {
        $this->period_start = $period_start;
        return $this;
    }

    /**
     *  the ending date that the invoice covers
     */
    public function setPeriodEnd($period_end) {
        $this->period_end = $period_end;
        return $this;
    }

    /**
     * payment status for this invoice (pending, successful, failed)
     */
    public function setState($state) {
        $this->state = $state;
        return $this;
    }

    /**
     * combined total of charges and credits on this invoice
     */
    public function setTotal($total) {
        $this->total = $total;
        return $this;
    }

    /**
     * when invoice was updated
     */
    public function setUpdatedAt($updated_at) {
       $this->updated_at = $updated_at;
       return $this;
    }

    
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