<?php

namespace LuzernTourismus\M365Mail\Dynamics365\Reader\Contact;

use LuzernTourismus\M365Mail\Dynamics365\Reader\Base\AbstractDynamics365Reader;

class ContactEntityReader extends AbstractDynamics365Reader
{

    /**
     * @return
     */
    public function getDefinition()
    {

        $endpoint = '/EntityDefinitions(LogicalName=\'contact\')/Attributes?$select=LogicalName,DisplayName,AttributeType';
        $this->logName = 'contact_entity';

        $valueList = $this->getJsonData($endpoint);

        $list = [];

        foreach ($valueList as $value) {


        }

        return $list;

    }

}