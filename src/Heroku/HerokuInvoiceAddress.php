<?php

namespace PonderSource\HerokuApi;
use PonderSource\HerokuApi\HerokuClient;

class HerokuInvoiceAddress {
    public function getHerokuInvoiceAddress() {
        $TUTORIAL_KEY=`(echo -n; heroku auth:token)` ; 
        $heroku = new HerokuClient([
            'apiKey' => $TUTORIAL_KEY,
        ]);
        $invoice_address = $heroku->get('account/invoice-address');
        echo '<pre>';
        var_dump($invoice_address);
        echo '</pre>';
        file_put_contents("heroku_invoice_address.json", json_encode($invoice_address, JSON_PRETTY_PRINT));

    }
}