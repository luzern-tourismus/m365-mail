<?php

use Nemundo\Core\Debug\Debug;
use Nemundo\Project\Config\ProjectConfigReader;

require __DIR__ . '/../../config.php';

(new \LuzernTourismus\M365Mail\Dynamics365\Reader\Contact\ContactEntityReader())->getDefinition();




