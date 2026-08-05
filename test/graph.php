<?php

use Nemundo\Core\Debug\Debug;

require_once __DIR__ . "/../config.php";

//$url='https://graph.microsoft.com/v1.0/me/memberOf?$select=id';
/*$url = 'https://graph.microsoft.com/v1.0/groups?$select=id,displayName&$top=999';


$token = (new ClientToken())->getToken();

$request = new \Nemundo\Core\WebRequest\BearerAuthentication\JsonBearerAuthenticationWebRequest();
$request->bearerAuthentication = $token;
$response = $request->getUrl($url);

(new \Nemundo\Core\Debug\Debug())->write($response);*/

(new Debug())->write( (new \LuzernTourismus\M365Mail\Graph\Request\GraphRequest())->getData('groups?$select=id,displayName&$top=999'));




