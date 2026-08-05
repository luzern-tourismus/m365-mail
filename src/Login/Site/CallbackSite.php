<?php

namespace LuzernTourismus\M365Mail\Login\Site;

use LuzernTourismus\M365Mail\Login\Token\CallbackToken;
use LuzernTourismus\M365Mail\Profile\ProfileRequest;
use Nemundo\Core\Debug\Debug;
use Nemundo\Project\Config\ProjectConfigReader;
use Nemundo\Web\Site\AbstractSite;

class CallbackSite extends AbstractSite
{

    /**
     * @var SsoLoginSite
     */
    public static $site;

    protected function loadSite()
    {

        $this->url = 'callback';
        $this->menuActive = false;

        CallbackSite::$site = $this;

    }

    public function loadContent()
    {

        /*$tenantId = (new ProjectConfigReader())->getValue('m365_tenant_id');
        $clientId = (new ProjectConfigReader())->getValue('m365_sso_application_id');
        $clientSecret = (new ProjectConfigReader())->getValue('m365_sso_client_secret');
        $redirectUri = (new ProjectConfigReader())->getValue('m365_sso_redirect_uri');*/

        $login = new CallbackToken();
        /*$login->tenantId = $tenantId;
        $login->clientId = $clientId;
        $login->clientSecret = $clientSecret;
        $login->redirectUri = $redirectUri;*/
        $token = $login->getToken();

        $request = new ProfileRequest();
        $request->token = $token;
        $profile = $request->getProfile();

        (new Debug())->write($profile);


    }

}