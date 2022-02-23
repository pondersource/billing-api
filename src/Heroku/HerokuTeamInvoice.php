<?php

namespace PonderSource\HerokuApi;

use PonderSource\HerokuApi\HerokuClient;


class HerokuTeamInvoice {
    public function getHerokuTeamInvoice() {
        $heroku = new HerokuClient([
            'apiKey' => 'YOUR_API_HERE',
        ]);
         
         //Account information
         $team_invoices = $heroku->get('teams/a2516ec8-8e5e-48ae-b0cc-2051aab43893/invoices');
         echo '<pre>';
         var_dump($team_invoices);
         echo '</pre>';      
         file_put_contents("team_invoices.json", json_encode($team_invoices, JSON_PRETTY_PRINT)); 
       
    }
}