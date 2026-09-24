<?php

namespace LuzernTourismus\M365Mail\Login\Site;

use LuzernTourismus\M365Mail\Login\Token\CallbackToken;
use LuzernTourismus\M365Mail\Profile\ProfileRequest;
use Nemundo\Core\Debug\Debug;
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

        $login = new CallbackToken();
        $token = $login->getToken();

        $request = new ProfileRequest();
        $request->token = $token;
        $profile = $request->getProfile();

        (new Debug())->write($profile);


    }

}