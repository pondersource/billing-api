<?php

namespace PonderSource\HerokuApi;
use PonderSource\HerokuApi\HerokuClient;

class HerokuAccount {
    public function getHerokuAccount(){
        $heroku = new HerokuClient([
            'apiKey' => 'YOUR_API_HERE',
        ]);
         
         //Account information
         $account = $heroku->get('account');
         echo '<pre>';
         var_dump($account);
         echo '</pre>';      
         file_put_contents("account.json", json_encode($account, JSON_PRETTY_PRINT));   
    }
}