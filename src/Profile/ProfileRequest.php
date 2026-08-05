<?php

namespace LuzernTourismus\M365Mail\Profile;

use Nemundo\Core\Debug\Debug;
use Nemundo\Core\Json\Reader\JsonReader;
use Nemundo\Core\WebRequest\BearerAuthentication\JsonBearerAuthenticationWebRequest;

class ProfileRequest
{


    public $token;


    public function getProfile()
    {

        $url = 'https://graph.microsoft.com/v1.0/me';

        $curl = new JsonBearerAuthenticationWebRequest();
        $curl->bearerAuthentication = $this->token;
        $response = $curl->getUrl($url);

        (new Debug())->write($response);

        $profileJson = (new JsonReader())->fromText($response->html)->getData();

        $profile = new Profile($profileJson);

        return $profile;




    }



}