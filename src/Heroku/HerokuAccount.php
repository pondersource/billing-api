<?php

namespace PonderSource\HerokuApi;
use PonderSource\HerokuApi\HerokuClient;

class HerokuAccount {
    public function getHerokuAccount(){
        $TUTORIAL_KEY=`(echo -n; heroku auth:token)` ; 
        $heroku = new HerokuClient([
            'apiKey' => $TUTORIAL_KEY,
        ]);
         
         //Account information
         $account = $heroku->get('account');
         echo '<pre>';
         var_dump($account);
         echo '</pre>';      
         file_put_contents("account.json", json_encode($account, JSON_PRETTY_PRINT));   
    }
}