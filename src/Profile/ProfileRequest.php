<?php

namespace LuzernTourismus\M365Mail\Profile;

use LuzernTourismus\M365Mail\Graph\Reader\UsergroupItem;
use LuzernTourismus\M365Mail\Graph\Request\GraphRequest;
use Nemundo\Core\Json\Reader\JsonReader;
use Nemundo\Core\WebRequest\BearerAuthentication\JsonBearerAuthenticationWebRequest;

class ProfileRequest
{

    public $token;

    public function getProfile()
    {

        $url = 'https://graph.microsoft.com/v1.0/me';

        $curl = new JsonBearerAuthenticationWebRequest();
        $curl->bearerAuthentication = $this->token;
        $response = $curl->getUrl($url);

        $profileJson = (new JsonReader())->fromText($response->html)->getData();
        $profile = new Profile($profileJson);

        return $profile;

    }


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

        $endpoint = 'me/transitiveMemberOf/microsoft.graph.group?$select=id,displayName';

        $list = [];
        $data = (new GraphRequest())->getData($endpoint);
        foreach ($data as $usergroupJson) {
            $list[] = new UsergroupItem($usergroupJson);
        }

        return $list;

    }

}