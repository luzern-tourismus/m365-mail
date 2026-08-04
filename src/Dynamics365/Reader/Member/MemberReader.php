<?php

namespace LuzernTourismus\M365Mail\Dynamics365\Reader\Member;

use LuzernTourismus\M365Mail\Dynamics365\Reader\Base\AbstractDynamics365Reader;

class MemberReader extends AbstractDynamics365Reader
{

    /**
     * @return Member[]
     */
    public function getData($listId) {

        $endpoint = '('.$listId.')/listcontact_association?$select=contactid,fullname,salutation,firstname,lastname,emailaddress1,telephone1,mobilephone&$expand=parentcustomerid_account($select=name,telephone1,emailaddress1,websiteurl,address1_line1,address1_postalcode,address1_city)';

        $valueList = $this->getJsonData($endpoint);

        $list = [];

        foreach ($valueList as $value) {

            $marketingList = new Member($value);
            $list[] = $marketingList;

        }

        return $list;

    }

}