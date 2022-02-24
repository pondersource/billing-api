<?php

namespace PonderSource\HerokuApi;

use PonderSource\HerokuApi\HerokuClient;

class HerokuTeams {
    public function getHerokuTeams() {
        $TUTORIAL_KEY=`(echo -n; heroku auth:token)` ; 
        $heroku = new HerokuClient([
            'apiKey' => $TUTORIAL_KEY,
        ]);
         
         //Account information
         $teams = $heroku->get('teams');
         echo '<pre>';
         var_dump($teams);
         echo '</pre>';      
         file_put_contents("heroku_teams.json", json_encode($teams, JSON_PRETTY_PRINT));   
    }
}