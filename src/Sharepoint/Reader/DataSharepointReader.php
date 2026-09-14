<?php

namespace LuzernTourismus\M365Mail\Sharepoint\Reader;

use LuzernTourismus\M365Mail\Graph\Request\GraphRequest;
use Nemundo\Core\Debug\Debug;

class DataSharepointReader extends AbstractSharepointReader
{

    public $siteId;

    public $listName;

    protected function loadData()
    {

        $endpoint = 'sites/' . $this->siteId . '/lists/' . $this->listName . '/items';
        $data = new GraphRequest()->getData($endpoint);

        foreach ($data as $row) {

            new Debug()->write($row);

            /*$column = new ColumnItem($row);
            $this->addItem($column);*/
        }

    }

}