<?php

namespace LuzernTourismus\M365Mail\Graph\Reader;

use LuzernTourismus\M365Mail\Graph\Request\GraphRequest;
use Nemundo\Core\Base\AbstractBase;

class UsergroupReader extends AbstractBase
{

    /**
     * @return UsergroupItem[]
     */
    public function getUsergroupList()
    {

        $endpoint = 'groups?$select=id,displayName&$top=999';

        $list = [];
        $data = (new GraphRequest())->getData($endpoint);
        foreach ($data as $usergroupJson) {
            $list[] = new UsergroupItem($usergroupJson);
        }

        return $list;

    }

}