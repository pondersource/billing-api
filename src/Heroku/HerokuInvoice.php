<?php 

namespace PonderSource\HerokuApi;

class HerokuInvoice {
    public function getHerokuInvoices() {
        $heroku = new HerokuClient([
            'apiKey' => 'YOUR_API_HERE',
         ]);
        $invoice = $heroku->get('account/invoices');
        echo '<pre>';
        var_dump($invoice);
        echo '</pre>';
        file_put_contents("invoice.json", json_encode($invoice, JSON_PRETTY_PRINT));
    }
}