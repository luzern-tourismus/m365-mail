<?php

use LuzernTourismus\M365Mail\Login\Token\LoginUrlBuilder;
use Nemundo\Core\Debug\Debug;
use Nemundo\Project\Config\ProjectConfigReader;

require_once __DIR__ . "/../../config.php";



/*$tenantId = (new ProjectConfigReader())->getValue('m365_tenant_id');
$clientId = (new ProjectConfigReader())->getValue('m365_sso_application_id');
//$clientSecret = (new ProjectConfigReader())->getValue('m365_client_secret');
$redirectUri ='http://localhost:16238/callback';*/

$builder = new LoginUrlBuilder();
/*$builder->tenantId = $tenantId;
$builder->clientId = $clientId;
$builder->redirectUri = $redirectUri;*/
(new Debug())->write($builder->getLoginUrl());

