<?php

require_once __DIR__ . "/../../config.php";



$login = new \LuzernTourismus\M365Mail\Login\Token\AuthorizationToken();

$login->getToken();




