<?php

namespace PonderSource\HerokuApi;

use PonderSource\HerokuApi\HerokuAccount;
use PonderSource\HerokuApi\HerokuInvoice;
use PonderSource\HerokuApi\HerokuInvoiceAddress;
use PonderSource\HerokuApi\HerokuTeamInvoice;
use PonderSource\HerokuApi\HerokuTeams;
use PonderSource\HerokuApi\HerokuAddons;


class HerokuApiEndpoint {
    public function getUrlAccount($url) {
        switch($url) {
            case "/heroku/account":
                $herokuAccount = new HerokuAccount;
                $herokuAccount->getHerokuAccount();
                return $herokuAccount;
                break;
            case "/heroku/invoices":
                $herokuInvoices = new HerokuInvoice();
                $herokuInvoices->getHerokuInvoices();
                return $herokuInvoices;
                break;
            case "/heroku/invoices":
                 $herokuInvoices = new HerokuInvoice();
                 $herokuInvoices->getHerokuInvoices();
                 return $herokuInvoices;
                 break;
            case "/heroku/invoice-address":
                $herokuInvoiceAddress = new HerokuInvoiceAddress();
                $herokuInvoiceAddress->getHerokuInvoiceAddress();
                return $herokuInvoiceAddress;
                break;
            case "/heroku/teams":
                $herokuTeams = new HerokuTeams();
                $herokuTeams->getHerokuTeams();
                return $herokuTeams;
                break;
            case "/heroku/teams/pondersource/addons":
                $herokuAddons = new HerokuAddons();
                $herokuAddons->getHerokuAddons();
                return $herokuAddons;
                break;
                
             case "/heroku/teams/pondersource/invoices":
                $herokuTeamInvoices = new HerokuTeamInvoice();
                $herokuTeamInvoices->getHerokuTeamInvoice();
                return $herokuTeamInvoices;
                break;
        }
    }
}