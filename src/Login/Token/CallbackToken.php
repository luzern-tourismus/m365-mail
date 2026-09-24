<?php

namespace LuzernTourismus\M365Mail\Login\Token;

use LuzernTourismus\M365Mail\Login\Session\StateSession;

class CallbackToken extends AbstractToken
{

    protected function loadToken()
    {

        $this->grantType = 'authorization_code';

    }


    protected function loadData($postData)
    {

        $code = $_GET['code'];
        $state = $_GET['state'];

        if (new StateSession()->getValue() !== $state) {
            http_response_code(400);
            exit('Invalid OAuth state');
        }

        new StateSession()->deleteSession();

        $postData['code'] = $code;
        $postData['redirect_uri'] = $this->redirectUri;

        return $postData;

    }

}