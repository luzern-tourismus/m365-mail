<?php

namespace LuzernTourismus\M365Mail\Login\Token;

use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Debug\Debug;
use Nemundo\Core\Json\Reader\JsonReader;
use Nemundo\Core\WebRequest\Curl\CurlWebRequest;
use Nemundo\Project\Config\ProjectConfigReader;

abstract class AbstractToken extends AbstractBase
{

    protected $scope;

    protected $tenantId;

    protected $applicationId;

    protected $clientSecret;

    protected $grantType;


    abstract protected function loadToken();


    abstract protected function loadData($postData);


    public function __construct()
    {

        $this->loadToken();

    }


    public function getToken()
    {

        if ($this->tenantId === null) {
            $this->tenantId = (new ProjectConfigReader())->getValue('m365_tenant_id');
        }

        if ($this->applicationId === null) {
            $this->applicationId = (new ProjectConfigReader())->getValue('m365_application_id');
        }

        if ($this->clientSecret === null) {
            $this->clientSecret = (new ProjectConfigReader())->getValue('m365_client_secret');
        }

        $tokenUrl = 'https://login.microsoftonline.com/' . $this->tenantId . '/oauth2/v2.0/token';

        $postData = [];
        $postData['client_id'] = $this->applicationId;
        $postData['scope'] = $this->scope;
        $postData['client_secret'] = $this->clientSecret;
        $postData['grant_type'] = $this->grantType;
        //$postData['grant_type'] = 'client_credentials';

        $postData = $this->loadData($postData);


        /*
                $tokenUrl = 'https://login.microsoftonline.com/' . $tenantId . '/oauth2/v2.0/token';

                $postData = [];
                $postData['client_id'] = $clientId;
                $postData['scope'] = 'openid profile email';
                $postData['client_secret'] = $clientSecret;
                $postData['grant_type'] = 'authorization_code';
                $postData['code'] = $code;
                $postData['redirect_uri']='http://localhost:16238/callback';*/


        $tokenRequest = new CurlWebRequest();
        $tokeResponse = $tokenRequest->postUrl($tokenUrl, $postData);

        $tokenJson = (new JsonReader())->fromText($tokeResponse->html)->getData();

        if ($tokeResponse->statusCode === 400) {
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

        return $token;

    }

}