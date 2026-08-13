<?php

namespace LuzernTourismus\M365Mail\Profile;

use LuzernTourismus\M365Mail\Graph\Reader\UsergroupItem;
use Nemundo\Core\Base\AbstractBase;

class Profile extends AbstractBase
{

    public readonly string $email;

    public readonly string $login;

    public readonly string $name;

    private $profileJson;


    public function __construct($profileJson)
    {

        $this->profileJson = $profileJson;

        $this->email = $profileJson['mail'];
        $this->login = $profileJson['userPrincipalName'];
        $this->name = $profileJson['displayName'];

    }


   /* public function isMemberOfUsergroup($usergroupId)
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
    /*public function getGroupMembershipList()
    {

        foreach ($this->profileJson['memberOf'] as $usergroupJson) {
            $list[] = new UsergroupItem($usergroupJson);
        }

        return $list;

    }*/

}