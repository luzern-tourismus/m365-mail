<?php

namespace LuzernTourismus\M365Mail\Graph\Reader;

use Nemundo\Core\Base\AbstractBase;

class UsergroupItem extends AbstractBase
{

    public readonly string $id;

    public readonly string $displayName;


    public function __construct($json)
    {

        $this->id = $json['id'];

        $value = $json['displayName'];
        if (is_string($value)) {
            $this->displayName = $value;
        } else {
            $this->displayName = null;
        }

    }

}