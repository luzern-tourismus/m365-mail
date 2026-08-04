<?php

use LuzernTourismus\M365Mail\Dynamics365\Reader\MarketingList\MarketingListReader;
use Nemundo\Core\Debug\Debug;

require __DIR__ . '/../../config.php';


foreach ((new MarketingListReader())->getData() as $marketingList) {

    (new Debug())->write($marketingList->description);
    (new Debug())->write($marketingList->listName);
    (new Debug())->write($marketingList->listId);

}


