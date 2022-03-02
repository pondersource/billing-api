<?php

namespace PonderSource\HerokuApi;
use PonderSource\HerokuApi\HerokuClient;
use PonderSource\Library\DotEnv;
(new DotEnv('/var/www/billing-api/' . '/.env'))->load();

class Heroku {
    public function getHeroku($url, $fileName){
      
        //$TUTORIAL_KEY=`(echo -n; heroku auth:token)` ; 
        $heroku = new HerokuClient([
            'apiKey' => getenv('HEROKU_API_KEY'),
            'baseUrl' => 'https://api.heroku.com/',   // Defaults to https://api.heroku.com/
        ]);
         
         //Account information
         $account = $heroku->get($url);
         echo '<pre>';
         var_dump($account);
         echo '</pre>';      
         file_put_contents($fileName, json_encode($account, JSON_PRETTY_PRINT));   
    }
}