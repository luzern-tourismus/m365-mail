<?php

use Nemundo\Core\Debug\Debug;

require_once __DIR__ . "/../config.php";



// https://lutag.sharepoint.com/teams/IntranetTest/Lists/Vertrag/AllItems.aspx?npsAction=createList


//$endpoint='/sites/lutag.sharepoint.com:/sites/IntranetTest';
/*$endpoint='sites/lutag.sharepoint.com:/teams/IntranetTest';
(new Debug())->write( (new \LuzernTourismus\M365Mail\Graph\Request\GraphRequest())->getData($endpoint));*/



$siteId = 'lutag.sharepoint.com,0369592d-82fc-4550-a577-71f5617dc274,b16cfe5e-1d35-408a-b954-d8c53ecd1dbf';
$listName = 'Vertrag';

//$endpoint = '/sites/'.$siteId.'/lists/'.$listName.'/items?$expand=fields';

$endpoint = 'sites/'.$siteId.'/lists/'.$listName.'/columns';
(new Debug())->write( (new \LuzernTourismus\M365Mail\Graph\Request\GraphRequest())->getData($endpoint));


//GET https://graph.microsoft.com/v1.0/sites/{site-id}/lists/{list-id}/columns

exit;



$endpoint = 'sites/'.$siteId.'/lists/'.$listName.'/items';

//sites/$siteId/lists/$listName/items";

$data=[];
$data['Title'] = 'Testeintrag';
$data['Firma'] = 'Testfirma';


/*
$result = createListItem($siteId, $listName, $token, [
    'Title'        => 'Testeintrag',
    'Beschreibung' => 'Dieser Eintrag wurde per PHP (Graph API) erstellt.',
])

$result = createListItem($siteId, $listName, $token, [
    'Title'        => 'Testeintrag',
    'Beschreibung' => 'Dieser Eintrag wurde per PHP (Graph API) erstellt.',
])*/


(new Debug())->write( (new \LuzernTourismus\M365Mail\Graph\Request\GraphRequest())->postData($endpoint,$data));





//(new Debug())->write( (new \LuzernTourismus\M365Mail\Graph\Request\GraphRequest())->getData($endpoint));






//GET https://graph.microsoft.com/v1.0/sites/lutag.sharepoint.com:/sites/IntranetTest