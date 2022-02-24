<?php

namespace PonderSource\HerokuApi;
use PonderSource\HerokuApi\HerokuClient;

class Heroku {
    public function getHeroku($url, $fileName){
        $TUTORIAL_KEY=`(echo -n; heroku auth:token)` ; 
        $heroku = new HerokuClient([
            'apiKey' => $TUTORIAL_KEY,
        ]);
         
         //Account information
         $account = $heroku->get($url);
         echo '<pre>';
         var_dump($account);
         echo '</pre>';      
         file_put_contents($fileName, json_encode($account, JSON_PRETTY_PRINT));   
    }
}