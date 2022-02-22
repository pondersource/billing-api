<?php

namespace Ishifoev\HerokuApi;
use Ishifoev\HerokuApi\HerokuClient;

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
    }
}