<?php

namespace LuzernTourismus\M365Mail\Login\Token;

class ClientToken extends AbstractToken
{

    public $scope;

    protected function loadToken()
    {

        $this->scope = 'https://graph.microsoft.com/.default';
        $this->grantType = 'client_credentials';

    }


    protected function loadData($postData)
    {
        //$postData['grant_type'] = 'client_credentials';

        return $postData;

    }




    /*public function getToken($scope = 'https://graph.microsoft.com/.default')
    {

        $tenantId = (new ProjectConfigReader())->getValue('m365_tenant_id');
        $applicationId = (new ProjectConfigReader())->getValue('m365_application_id');
        $clientSecret = (new ProjectConfigReader())->getValue('m365_client_secret');

        $tokenUrl = 'https://login.microsoftonline.com/' . $tenantId . '/oauth2/v2.0/token';

        $postData = [];
        $postData['client_id'] = $applicationId;
        $postData['scope'] = $scope;
        $postData['client_secret'] = $clientSecret;
        $postData['grant_type'] = 'client_credentials';

/*
        $tokenUrl = 'https://login.microsoftonline.com/' . $tenantId . '/oauth2/v2.0/token';

        $postData = [];
        $postData['client_id'] = $clientId;
        $postData['scope'] = 'openid profile email';
        $postData['client_secret'] = $clientSecret;
        $postData['grant_type'] = 'authorization_code';
        $postData['code'] = $code;
        $postData['redirect_uri']='http://localhost:16238/callback';*/


    /*   $tokenRequest = new CurlWebRequest();
       $tokeResponse = $tokenRequest->postUrl($tokenUrl, $postData);

       $tokenJson = (new JsonReader())->fromText($tokeResponse->html)->getData();

       $token = null;
       if (isset($tokenJson['access_token'])) {
           $token = $tokenJson['access_token'];
       } else {
           (new Debug())->write('No valid token');
           (new Debug())->write($tokeResponse);
       }

       return $token;

   }*/

}