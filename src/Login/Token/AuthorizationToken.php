<?php

namespace LuzernTourismus\M365Mail\Login\Token;

class AuthorizationToken extends AbstractToken
{


    public $code;

    public $redirectUri;



    protected function loadData($postData)
    {


        $postData['code'] = $this->code;
        $postData['redirect_uri']=$this->redirectUri;

        return $postData;


    }

}