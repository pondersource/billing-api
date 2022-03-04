<?php

namespace PonderSource\HerokuApi;

use PonderSource\HerokuApi\Heroku;

class HerokuApiEndpoint {
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