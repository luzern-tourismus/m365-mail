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
        $this->displayName = $json['displayName'];

    }

}