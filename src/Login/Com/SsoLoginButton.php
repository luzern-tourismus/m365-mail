<?php

namespace LuzernTourismus\M365Mail\Login\Com;

use Nemundo\Com\Html\Hyperlink\SiteHyperlink;
use Nemundo\Html\Image\Img;

class SsoLoginButton extends SiteHyperlink
{

    public function getContent()
    {

        //$hyperlink = new SiteHyperlink($div);
        $this->site = \LuzernTourismus\M365Mail\Login\Site\SsoLoginSite::$site;  // SsoLoginSite::$site;
        $this->showSiteTitle=false;

        $img = new Img($this);
        $img->width=200;
        $img->src='https://learn.microsoft.com/en-us/entra/identity-platform/media/howto-add-branding-in-apps/ms-symbollockup_signin_light.svg';


        return parent::getContent();

    }

}