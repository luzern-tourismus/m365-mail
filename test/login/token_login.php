<?php

use Nemundo\Core\Debug\Debug;

require_once __DIR__ . "/../../config.php";

$token = (new \LuzernTourismus\M365Mail\Login\TokenLogin())->getToken();

(new Debug())->write($token);
