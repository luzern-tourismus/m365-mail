<?php

use Nemundo\Core\Debug\Debug;

require __DIR__ . '/../../config.php';


$listId = '';

foreach ((new \LuzernTourismus\M365Mail\Dynamics365\Reader\Member\MemberReader()->getData($listId)) as $member) {

    (new Debug())->write($member->email);
    (new Debug())->write($member->company);
    (new Debug())->write($member->street);

}


