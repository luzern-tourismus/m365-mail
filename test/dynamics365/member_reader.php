<?php

use Nemundo\Core\Debug\Debug;
use Nemundo\Project\Config\ProjectConfigReader;

require __DIR__ . '/../../config.php';






$listId = (new ProjectConfigReader())->getValue( 'test_list_id');

foreach ((new \LuzernTourismus\M365Mail\Dynamics365\Reader\Member\MemberReader()->getData($listId)) as $member) {

    (new Debug())
        ->write($member->displayName)
        ->write($member->salutation)
        ->write($member->lastName)
        ->write($member->firstName)
        ->write($member->email)
        ->write($member->company)
        ->write($member->street)
        ->write('------------------');


}


