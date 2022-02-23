<?php

namespace PonderSource\HerokuApi;
use PonderSource\HerokuApi\HerokuClient;

class HerokuInvoiceAddress {
    public function getHerokuInvoiceAddress() {
        $heroku = new HerokuClient([
            'apiKey' => 'YOUR_API_HERE',
        ]);
        $invoice_address = $heroku->get('account/invoice-address');
        echo '<pre>';
        var_dump($invoice_address);
        echo '</pre>';
        file_put_contents("invoice_address.json", json_encode($invoice_address, JSON_PRETTY_PRINT));

    }
}