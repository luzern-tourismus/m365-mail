<?php

namespace LuzernTourismus\M365Mail\Login\Token;

use LuzernTourismus\M365Mail\Login\Base\LoginTrait;
use Nemundo\Core\Http\Url\UrlBuilder;
use Nemundo\Project\Config\ProjectConfigReader;

class LoginUrlBuilder
{

    use LoginTrait;


    /*public $tenantId;

    public $clientId;

    public $redirectUri;*/

    public function getLoginUrl()
    {


        $this->loadConfigFile();

        /*if ($this->tenantId === null) {
            $this->tenantId = (new ProjectConfigReader())->getValue('m365_tenant_id');
        }

        if ($this->applicationId === null) {
            $this->applicationId = (new ProjectConfigReader())->getValue('m365_application_id');
        }

        if ($this->clientSecret === null) {
            $this->clientSecret = (new ProjectConfigReader())->getValue('m365_client_secret');
        }*/

        $url = (new UrlBuilder('https://login.microsoftonline.com/' . $this->tenantId . '/oauth2/v2.0/authorize'))
            ->addRequestValue('client_id', $this->applicationId)
            ->addRequestValue('response_type', 'code')
            ->addRequestValue('redirect_uri', $this->redirectUri)
            ->addRequestValue('response_mode', 'query')
            ->addRequestValue('scope', 'openid profile email')
            ->addRequestValue('state', '12345')
            ->getUrl();

        return $url;

    }

}