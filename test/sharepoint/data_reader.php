<?php

require_once __DIR__ . '/../../config.php';


$reader = new \LuzernTourismus\M365Mail\Sharepoint\Reader\DataSharepointReader();

$reader->siteId = 'lutag.sharepoint.com,0369592d-82fc-4550-a577-71f5617dc274,b16cfe5e-1d35-408a-b954-d8c53ecd1dbf';
$reader->listName = 'Vertrag';

foreach ($reader->getData() as $column) {

    //new \Nemundo\Core\Debug\Debug()->write($column);

}






