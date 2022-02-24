<?php

namespace PonderSource\HerokuApi;

class HerokuAddons {
    public function getHerokuAddons() {
        $TUTORIAL_KEY=`(echo -n; heroku auth:token)` ; 
        $heroku = new HerokuClient([
            'apiKey' => $TUTORIAL_KEY,
        ]);
         
         //Account information
         $addons = $heroku->get('teams/a2516ec8-8e5e-48ae-b0cc-2051aab43893/addons');
         echo '<pre>';
         var_dump($addons);
         echo '</pre>';      
         file_put_contents("heroku_addons.json", json_encode($addons, JSON_PRETTY_PRINT));
    }
}