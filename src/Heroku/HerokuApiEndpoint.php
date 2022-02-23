<?php

namespace PonderSource\HerokuApi;

use PonderSource\HerokuApi\HerokuAccount;
use PonderSource\HerokuApi\HerokuInvoice;
use PonderSource\HerokuApi\HerokuInvoiceAddress;

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
                  
        }
    }
}