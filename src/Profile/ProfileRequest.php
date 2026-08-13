<?php

namespace LuzernTourismus\M365Mail\Profile;

use LuzernTourismus\M365Mail\Graph\Config\GraphConfig;
use LuzernTourismus\M365Mail\Graph\Reader\UsergroupItem;
use LuzernTourismus\M365Mail\Graph\Request\GraphRequest;
use Nemundo\Core\Json\Reader\JsonReader;
use Nemundo\Core\TextFile\Writer\TextFileWriter;
use Nemundo\Core\WebRequest\BearerAuthentication\JsonBearerAuthenticationWebRequest;
use Nemundo\Project\Path\TmpPath;

class ProfileRequest
{

    public $token;

    public function getProfile()
    {

        $url = 'https://graph.microsoft.com/v1.0/me?$expand=transitiveMemberOf';

        $curl = new JsonBearerAuthenticationWebRequest();
        $curl->bearerAuthentication = $this->token;
        $response = $curl->getUrl($url);

        if (GraphConfig::$debugMode) {

            $filename = (new TmpPath())->addPath('profile.json')->getFullFilename();

            $file = new TextFileWriter($filename);
            $file->overwriteExistingFile = true;
            $file->addLine($response->html);
            $file->writeFile();

        }

        $profileJson = (new JsonReader())->fromText($response->html)->getData();
        $profile = new Profile($profileJson);

        return $profile;

    }

}