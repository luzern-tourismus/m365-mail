<?php

namespace LuzernTourismus\M365Mail\Login\Token;

use Nemundo\Core\Http\Url\UrlBuilder;

class LoginUrlBuilder
{

    public $tenantId;

    public $clientId;

    public $redirectUri;

    public function getLoginUrl()
    {

        $url = (new UrlBuilder('https://login.microsoftonline.com/' . $this->tenantId . '/oauth2/v2.0/authorize'))
            ->addRequestValue('client_id', $this->clientId)
            ->addRequestValue('response_type', 'code')
            ->addRequestValue('redirect_uri', $this->redirectUri)
            ->addRequestValue('response_mode', 'query')
            ->addRequestValue('scope', 'openid profile email')
            ->addRequestValue('state', '12345')
            ->getUrl();

        return $url;

    }

}