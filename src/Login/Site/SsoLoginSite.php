<?php

namespace LuzernTourismus\M365Mail\Login\Site;

use LuzernTourismus\M365Mail\Login\Token\LoginUrlBuilder;
use Nemundo\Core\Http\Url\UrlRedirect;
use Nemundo\Project\Config\ProjectConfigReader;
use Nemundo\Web\Site\AbstractSite;

class SsoLoginSite extends AbstractSite
{

    /**
     * @var SsoLoginSite
     */
    public static $site;

    protected function loadSite()
    {

        $this->title = 'SSO Login';
        $this->url = 'sso-login';
        $this->menuActive = false;

        SsoLoginSite::$site = $this;

    }

    public function loadContent()
    {

        $builder = new LoginUrlBuilder();
        new UrlRedirect()->redirect($builder->getLoginUrl());

    }

}