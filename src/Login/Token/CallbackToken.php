<?php

namespace LuzernTourismus\M365Mail\Login\Token;

use Nemundo\Core\Debug\Debug;

class CallbackToken extends AbstractToken
{




    public $tenantId;
    public $clientId;
    //public $clientSecret;
    public $redirectUri;


    protected function loadData($postData) {


        (new Debug())->write($_GET);

        $code = $_GET['code'];
        $state = $_GET['state'];

        $postData['grant_type'] = 'authorization_code';
        $postData['code'] = $code;
        $postData['redirect_uri']= $this->redirectUri;


        return $postData;

    }


    /*public function getToken()
    {


        /*$tenantId = (new ProjectConfigReader())->getValue('m365_tenant_id');
        $clientId = (new ProjectConfigReader())->getValue('m365_sso_application_id');
        $clientSecret = (new ProjectConfigReader())->getValue('m365_sso_client_secret');*/


      /*  (new Debug())->write($_GET);

        $code = $_GET['code'];
        $state = $_GET['state'];

        /*if (!$code || !$state || !$expected || !hash_equals($expected, $state)) {
            http_response_code(400);
            exit('Ungültige oder abgelaufene Anmeldeanfrage.');
        }*/


/*        $token = new TokenLogin();


        $tokenUrl = 'https://login.microsoftonline.com/' . $tenantId . '/oauth2/v2.0/token';

        $postData = [];
        $postData['client_id'] = $clientId;
        $postData['scope'] = 'openid profile email';
        $postData['client_secret'] = $clientSecret;
        $postData['grant_type'] = 'authorization_code';
        $postData['code'] = $code;
        $postData['redirect_uri']='http://localhost:16238/callback';

        $tokenRequest = new CurlWebRequest();
        $tokeResponse = $tokenRequest->postUrl($tokenUrl, $postData);

        (new Debug())->write($tokeResponse);

        $tokenJson = (new JsonReader())->fromText($tokeResponse->html)->getData();

        if ($tokeResponse->statusCode ===400) {
            //(new Debug())->write('No valid token');

            //"error":"invalid_grant","error_description

            $error = $tokenJson['error'];
            $errorDescription = $tokenJson['error_description'];


            (new Debug())->write($errorDescription);


        }




        $token = null;
        if (isset($tokenJson['access_token'])) {
            $token = $tokenJson['access_token'];
        } else {
            (new Debug())->write('No valid token');
            (new Debug())->write($tokeResponse);
        }


    }*/


}