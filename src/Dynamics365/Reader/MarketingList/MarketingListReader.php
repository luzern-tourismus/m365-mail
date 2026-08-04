<?php

namespace LuzernTourismus\M365Mail\Dynamics365\Reader\MarketingList;

use LuzernTourismus\M365Mail\Dynamics365\Reader\Base\AbstractDynamics365Reader;

class MarketingListReader extends AbstractDynamics365Reader
{

    /**
     * @return MarketingList[]
     */
    public function getData()
    {

        $endpoint = '?$select=listid,listname,createdfromcode,type,purpose,description';
        $valueList = $this->getJsonData($endpoint);

        $list = [];

        foreach ($valueList as $value) {

            $marketingList = new MarketingList($value);
            $list[] = $marketingList;

        }

        return $list;

    }

}