<?php

namespace PonderSource\HerokuApi;

use PonderSource\HerokuApi\Heroku;
use PonderSource\HerokuApi\Invoice;
use Sabre\Xml\Service;
use PonderSource\HerokuApi\GenerateInvoice;
use PonderSource\HerokuApi\DeserializeInvoice;

class HerokuApiEndpoint {
    public function getHerokuInvoice(){
      
        $TUTORIAL_KEY=`(echo -n; heroku auth:token)` ; 
        $invoice = new Invoice;
        $heroku = new HerokuClient([
            'apiKey' => $TUTORIAL_KEY,
            'baseUrl' => 'https://api.heroku.com/',   // Defaults to https://api.heroku.com/
        ]);
         
         //Account information
         $account = $heroku->get('account/invoices');
         foreach($account as $res) {
             $invoice->charges_total = $res->charges_total;
             $invoice->created_at = $res->created_at;
             $invoice->credits_total = $res->credits_total;
             $invoice->id = $res->id;
             $invoice->number = $res->number;
             $invoice->period_start = $res->period_start;
             $invoice->period_end = $res->period_end;
             $invoice->state = $res->state;
             $invoice->total = $res->total;
             $invoice->updated_at = $res->updated_at;

             $generateInvoice = new GenerateInvoice();
             $outputXMLString = $generateInvoice->invoice($invoice);

             $deserializeInvoice = new DeserializeInvoice();
             $deserialize = $deserializeInvoice->deserializeInvoice($outputXMLString);
             var_dump($deserialize);
          
             $dom = new \DOMDocument;
             $dom->loadXML($outputXMLString);
             $dom->save('EN16931Test.xml');
         }
         echo '<pre>';
         var_dump($account);
         echo '</pre>';      
         file_put_contents("heroku_invoice.json", json_encode($account, JSON_PRETTY_PRINT));   
    }
    public function getUrlAccount($url) {
        $heroku= new Heroku;
        switch($url) {
            case "/heroku/account":
                $heroku->getHeroku('account','heroku_account.json');
                return $heroku;
                break;
            case "/heroku/invoices":
                //$herokuInvoices = new HerokuInvoice();
                $heroku->getHeroku("account/invoices", "heroku_invoice.json");
                return $heroku;
                break;
            case "/heroku/invoice-address":
                $heroku->getHeroku("account/invoice-address", "heroku_invoice_address.json");
                return $heroku;
                break;
            case "/heroku/teams":
                $heroku->getHeroku("teams","heroku_teams.json");
                return $heroku;
                break;
            case "/heroku/teams/pondersource/addons":
                $heroku->getHeroku("teams/a2516ec8-8e5e-48ae-b0cc-2051aab43893/addons","heroku_addons.json");
                return $heroku;
                break;
                
             case "/heroku/teams/pondersource/invoices":
                $heroku->getHeroku("teams/a2516ec8-8e5e-48ae-b0cc-2051aab43893/invoices","heroku_team_invoices.json");
                return $heroku;
                break;
        }
    }
}