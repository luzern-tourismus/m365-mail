<?php

namespace LuzernTourismus\M365Mail\Login;

use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Debug\Debug;
use Nemundo\Core\Json\Reader\JsonReader;
use Nemundo\Core\WebRequest\Curl\CurlWebRequest;
use Nemundo\Project\Config\ProjectConfigReader;

class TokenLogin extends AbstractBase
{

    public function getToken($scope = 'https://graph.microsoft.com/.default')
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

        $tokenRequest = new CurlWebRequest();
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

    }

}