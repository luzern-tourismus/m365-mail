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

        return $postData;

    }

}