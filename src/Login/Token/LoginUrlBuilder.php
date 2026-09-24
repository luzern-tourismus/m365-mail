<?php

namespace LuzernTourismus\M365Mail\Login\Token;

use LuzernTourismus\M365Mail\Login\Base\LoginTrait;
use LuzernTourismus\M365Mail\Login\Session\StateSession;
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

        $state = bin2hex(random_bytes(32));
        new StateSession()->setValue($state);  // $_SESSION['oauth_state'] = $state;


        $url = (new UrlBuilder('https://login.microsoftonline.com/' . $this->tenantId . '/oauth2/v2.0/authorize'))
            ->addRequestValue('client_id', $this->applicationId)
            ->addRequestValue('response_type', 'code')
            ->addRequestValue('redirect_uri', $this->redirectUri)
            ->addRequestValue('response_mode', 'query')
            ->addRequestValue('scope', 'openid profile email')
            ->addRequestValue('state', $state)
            ->getUrl();

        return $url;

    }

}