<?php

namespace LuzernTourismus\M365Mail\Login\Token;

use LuzernTourismus\M365Mail\Login\Base\LoginTrait;
use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Debug\Debug;
use Nemundo\Core\Json\Reader\JsonReader;
use Nemundo\Core\WebRequest\Curl\CurlWebRequest;
use Nemundo\Project\Config\ProjectConfigReader;

abstract class AbstractToken extends AbstractBase
{

    use LoginTrait;

    protected $scope;

    protected $grantType;


    abstract protected function loadToken();


    abstract protected function loadData($postData);


    public function __construct()
    {

        $this->loadToken();

    }


    public function getToken()
    {

        $this->loadConfigFile();

        $tokenUrl = 'https://login.microsoftonline.com/' . $this->tenantId . '/oauth2/v2.0/token';

        $postData = [];
        $postData['client_id'] = $this->applicationId;
        $postData['scope'] = $this->scope;
        $postData['client_secret'] = $this->clientSecret;
        $postData['grant_type'] = $this->grantType;

        $postData = $this->loadData($postData);

        $tokenRequest = new CurlWebRequest();
        $tokeResponse = $tokenRequest->postUrl($tokenUrl, $postData);

        $tokenJson = (new JsonReader())->fromText($tokeResponse->html)->getData();

        if ($tokeResponse->statusCode === 400) {

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