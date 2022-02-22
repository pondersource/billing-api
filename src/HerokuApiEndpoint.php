<?php

namespace Ishifoev\HerokuApi;

use Ishifoev\HerokuApi\HerokuAccount;

class HerokuApiEndpoint {
    public function getUrlAccount($url) {
        switch($url) {
            case "/heroku/account":
                $herokuAccount = new HerokuAccount;
                $herokuAccount->getHerokuAccount();
                return $herokuAccount;
                exit;
            case "/github/account":
                    $githubAccount = new GithubAccount;
                    $githubAccount->getGithubAccount();
                    return $githubAccount;
                    //$herokuAccount->getHerokuAccount();
                    //return $herokuAccount;
                    exit;
        }
    }
}