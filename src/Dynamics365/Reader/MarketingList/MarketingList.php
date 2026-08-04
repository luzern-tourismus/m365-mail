<?php

namespace LuzernTourismus\M365Mail\Dynamics365\Reader\MarketingList;

class MarketingList
{

    public readonly string $listId;

    public readonly string $listName;

    public readonly string|null $description;

    public function __construct($data)
    {

        $this->listId = $data['listid'];
        $this->listName = $data['listname'];

        if (is_string($data['description'])) {
            $this->description = $data['description'];
        } else {
            $this->description = null;
        }

    }

}