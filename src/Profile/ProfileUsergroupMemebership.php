<?php

namespace LuzernTourismus\M365Mail\Profile;

use LuzernTourismus\M365Mail\Graph\Config\GraphConfig;
use LuzernTourismus\M365Mail\Graph\Reader\UsergroupItem;
use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Debug\Debug;
use Nemundo\Core\Json\Reader\JsonReader;
use Nemundo\Core\TextFile\Writer\TextFileWriter;
use Nemundo\Core\WebRequest\BearerAuthentication\JsonBearerAuthenticationWebRequest;
use Nemundo\Project\Path\TmpPath;

class ProfileUsergroupMemebership extends AbstractBase
{


    public $token;


    public function isMemberOfUsergroup($usergroupId)
    {

        $value = false;
        foreach ($this->getGroupMembershipList() as $usergroupItem) {

            if ($usergroupItem->id === $usergroupId) {
                $value = true;
            }

        }

        return $value;

    }


    /**
     * @return UsergroupItem[]
     */
    public function getGroupMembershipList()
    {


        //$url = 'https://graph.microsoft.com/v1.0/me?$expand=transitiveMemberOf($top=999;$select=id,displayName)';
        //$url = 'https://graph.microsoft.com/v1.0/me?$expand=memberOf($top=999;$select=id,displayName)';
        $url = 'https://graph.microsoft.com/v1.0/me/memberOf?$top=999';

        //(new Debug())->write($url);

        $curl = new JsonBearerAuthenticationWebRequest();
        $curl->bearerAuthentication = $this->token;
        $response = $curl->getUrl($url);

        if (GraphConfig::$debugMode) {

            $filename = (new TmpPath())->addPath('profileusergroup.json')->getFullFilename();

            $file = new TextFileWriter($filename);
            $file->overwriteExistingFile = true;
            $file->addLine($response->html);
            $file->writeFile();

        }

        $profileJson = (new JsonReader())->fromText($response->html)->getData();
        //$profile = new Profile($profileJson);

        foreach ($profileJson['value'] as $usergroupJson) {
            $list[] = new UsergroupItem($usergroupJson);
        }

        return $list;

    }





}