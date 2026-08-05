<?php

namespace LuzernTourismus\M365Mail\Login\Base;

use Nemundo\Project\Config\ProjectConfigReader;

trait LoginTrait
{


    public $tenantId;

    public $applicationId;

    public $redirectUri;

    protected $clientSecret;


    protected function loadConfigFile()
    {

        if ($this->tenantId === null) {
            $this->tenantId = (new ProjectConfigReader())->getValue('m365_tenant_id');
        }

        if ($this->applicationId === null) {
            $this->applicationId = (new ProjectConfigReader())->getValue('m365_application_id');
        }

        if ($this->clientSecret === null) {
            $this->clientSecret = (new ProjectConfigReader())->getValue('m365_client_secret');
        }

        if ($this->redirectUri === null) {
            $this->redirectUri = (new ProjectConfigReader())->getValue('m365_sso_redirect_uri');
        }


    }


}