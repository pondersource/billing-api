<?php 

namespace PonderSource\HerokuApi;

class HerokuInvoice {
    public function getHerokuInvoices() {
        $TUTORIAL_KEY=`(echo -n; heroku auth:token)` ; 
        $heroku = new HerokuClient([
            'apiKey' => $TUTORIAL_KEY,
        ]);
        $invoice = $heroku->get('account/invoices');
        echo '<pre>';
        var_dump($invoice);
        echo '</pre>';
        file_put_contents("invoice.json", json_encode($invoice, JSON_PRETTY_PRINT));
    }
}