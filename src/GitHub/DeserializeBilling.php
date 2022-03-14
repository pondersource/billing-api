<?php

namespace PonderSource\GitHubApi;

use Sabre\Xml\Service;
use PonderSource\GitHubApi\Billing;
use PonderSource\GitHubApi\Billings;

class DeserializeBilling
{
    public function deserializeBilling($outputXMLString) {
        $service = new Service();
        $service->elementMap = [
            '{http://example.org/billings}billings' => function(\Sabre\Xml\Reader $reader) {
                $billings = new Billings();
                $children = $reader->parseInnerTree();
                foreach($children as $child) {
                    if ($child['value'] instanceof Billings) {
                        $billings->billings[] = $child['value'];
                    }
                }
                return $billings;
            },
            '{http://example.org/billings}billing' => function(\Sabre\Xml\Reader $reader) {
                $billing = new Billing();
                // Borrowing a parser from the KeyValue class.
                $keyValue = \Sabre\Xml\Deserializer\keyValue($reader, 'http://example.org/billings');

                if (isset($keyValue['total_minutes_used'])) {
                    $billing->total_minutes_used = $keyValue['total_minutes_used'];
                }
                if (isset($keyValue['total_paid_minutes_used'])) {
                    $billing->total_paid_minutes_used = $keyValue['total_paid_minutes_used'];
                }
                if (isset($keyValue['included_minutes'])) {
                    $billing->included_minutes = $keyValue['included_minutes'];
                }
                if (isset($keyValue['minutes_used_breakdown'])) {
                    $billing->minutes_used_breakdown = $keyValue['minutes_used_breakdown'];
                }
                return $billing;
            },
        ];
        return  $service->parse($outputXMLString);
    }
}
