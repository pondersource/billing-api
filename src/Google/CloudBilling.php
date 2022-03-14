<?php

namespace PonderSource\GoogleApi;

use Sabre\Xml\XmlSerializable;
use Sabre\Xml\Writer;

class CloudBilling implements XmlSerializable {
    public $sku_name;
    public $sku_id;
    public $sku_description;
    public $sku_provider_name;
    public $sku_service_name;
    public $sku_resource;
    public $sku_group;
    public $sku_usage_type;
    public $sku_effective_time;
    public $sku_usage_unit;
    public $sku_usage_unit_description;
    public $sku_base_unit;
    public $sku_base_unit_description;
    public $sku_base_unit_conversion_factor;
    public $sku_display_quantity;
    public $sku_start_usage_amount;
    public $sku_unit_price;

    function xmlSerialize(Writer $writer) {
        $ns = '{http://example.org/billings}billing';

        $writer->write([
            $ns . 'sku_name' => $this->sku_name,
            $ns . 'sku_id' => $this->sku_id,
            $ns . 'sku_description' => $this->sku_description,
            $ns . 'sku_service_name' => $this->sku_resource,
            $ns . 'sku_group' => $this->sku_group,
            $ns . 'sku_usage_type' => $this->sku_usage_type,
            $ns . 'sku_effective_time' => $this->sku_effective_time,
            $ns . 'sku_usage_unit' => $this->sku_usage_unit,
            $ns . 'sku_base_unit_description' => $this->sku_base_unit_description,
            $ns . 'sku_base_unit_conversion_factor' => $this->sku_base_unit_conversion_factor,
            $ns . 'sku_display_quantity' => $this->sku_display_quantity,
            $ns . 'sku_start_usage_amount' => $this->sku_start_usage_amount,
            $ns . 'sku_unit_price' => $this->sku_unit_price,
        ]);

    }
}