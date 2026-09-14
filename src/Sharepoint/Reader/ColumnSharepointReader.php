<?php

namespace LuzernTourismus\M365Mail\Sharepoint\Reader;

use LuzernTourismus\M365Mail\Graph\Request\GraphRequest;

class ColumnSharepointReader extends AbstractSharepointReader
{

    public $siteId;

    public $listName;

    protected function loadData()
    {

        $endpoint = 'sites/' . $this->siteId . '/lists/' . $this->listName . '/columns';
        $data = new GraphRequest()->getData($endpoint);

        foreach ($data as $row) {
            $column = new ColumnItem($row);
            $this->addItem($column);
        }

    }

}