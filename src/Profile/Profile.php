<?php

namespace LuzernTourismus\M365Mail\Profile;

use Nemundo\Core\Base\AbstractBase;

class Profile extends AbstractBase
{

    public readonly string $email;

    public readonly string $login;

    public readonly string $name;

    private $profileJson;


    public function __construct($profileJson)
    {

        $this->profileJson = $profileJson;

        $this->email = $profileJson['mail'];
        $this->login = $profileJson['userPrincipalName'];
        $this->name = $profileJson['displayName'];

    }

}