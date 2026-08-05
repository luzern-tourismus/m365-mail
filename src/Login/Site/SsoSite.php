<?php

namespace LuzernTourismus\M365Mail\Login\Site;

use LuzernTourismus\LcbMarketingProgramm\Data\Project\ProjectReader;
use Nemundo\Core\Http\Url\UrlBuilder;
use Nemundo\Core\Http\Url\UrlRedirect;
use Nemundo\Project\Config\ProjectConfigReader;
use Nemundo\Web\Site\AbstractSite;

class SsoSite extends AbstractSite
{

    /**
     * @var SsoLoginSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->title = 'SSO Login';
        $this->url = 'sso';
        $this->menuActive = false;

        SsoLoginSite::$site = $this;

        new SsoLoginSite($this);
        new CallbackSite($this);

    }

    public function loadContent()
    {



    }

}