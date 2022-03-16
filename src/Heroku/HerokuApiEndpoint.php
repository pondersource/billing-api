<?php

namespace PonderSource\HerokuApi;

use PonderSource\HerokuApi\Heroku;
use PonderSource\HerokuApi\Invoice;
use Sabre\Xml\Service;
use PonderSource\HerokuApi\GenerateInvoice;
use PonderSource\HerokuApi\DeserializeInvoice;
use PonderSource\HerokuApi\Invoices;

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
         //var_dump($account);
         $invoiceLines = [];
         foreach($account as $res) {

             $invoiceLines[] = (new  Invoice())
             ->setId($res->id)
             ->setChargeTotal($res->charges_total)
             ->setCreatedAt($res->created_at)
             ->setPeriodStart($res->period_start)
             ->setPeriodEnd($res->period_end)
             ->setNumber($res->number)
             ->setState($res->state)
             ->setTotal($res->total)
             ->setUpdatedAt($res->updated_at)
             ;
            
             $invoice = (new  Invoices())
             ->setInvoices($invoiceLines);
          
             $generateInvoice = new GenerateInvoice();
             $outputXMLString = $generateInvoice->invoice($invoice);

             $dom = new \DOMDocument;
             $dom->loadXML($outputXMLString);
             $dom->save('heroku_invoice.xml');
         }
        file_put_contents("heroku_invoice.json", json_encode($account, JSON_PRETTY_PRINT)); 
        return $invoice;
    }

    public function getHerokuTeamInvoices() {
        $TUTORIAL_KEY=`(echo -n; heroku auth:token)` ; 
        $invoice = new Invoice;
        $heroku = new HerokuClient([
            'apiKey' => $TUTORIAL_KEY,
            'baseUrl' => 'https://api.heroku.com/',   // Defaults to https://api.heroku.com/
        ]);

        $teams = $heroku->get('teams');
        
        foreach($teams as $team) {
            $team_invoices = $heroku->get("teams/" .$team->id. "/invoices");
        }
       

        $invoiceLines = [];
        foreach($team_invoices as $res) {

            $invoiceLines[] = (new  Invoice())
            ->setId($res->id)
            ->setChargeTotal($res->charges_total)
            ->setCreatedAt($res->created_at)
            ->setPeriodStart($res->period_start)
            ->setPeriodEnd($res->period_end)
            ->setNumber($res->number)
            ->setState($res->state)
            ->setTotal($res->total)
            ->setUpdatedAt($res->updated_at)
            ->setAddonsTotal($res->addons_total)
            ->setDatabaseTotal($res->database_total)
            ->setDynoUnits($res->dyno_units)
            ->setPlatformTotal($res->platform_total)
            ->setPaymentStatus($res->payment_status)
            ->setWeightedDynoHours($res->weighted_dyno_hours)
            ;
           
            $invoice = (new  Invoices())
            ->setInvoices($invoiceLines);
         
            $generateInvoice = new GenerateInvoice();
            $outputXMLString = $generateInvoice->invoice($invoice);

            $dom = new \DOMDocument;
            $dom->loadXML($outputXMLString);
            $dom->save('heroku_invoice_team.xml');
        }
        file_put_contents("heroku_team_invoices.json", json_encode($team_invoices, JSON_PRETTY_PRINT));
        return $team_invoices;
       
    }

    public function deserializeHerokuInvoice($outputXMLString) {
        $deserializeInvoice = new DeserializeInvoice();
        $deserialize = $deserializeInvoice->deserializeInvoice($outputXMLString);
        return $deserialize;
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