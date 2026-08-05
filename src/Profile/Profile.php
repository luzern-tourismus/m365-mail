<?php

namespace LuzernTourismus\M365Mail\Profile;

class Profile
{

    public readonly string $email;

    public readonly string $login;

    public readonly string $name;


    public function __construct($profileJson)
    {


        $this->email = $profileJson['mail'];
        $this->login = $profileJson['userPrincipalName'];
        $this->name = $profileJson['displayName'];


    }


}