<?php

namespace LuzernTourismus\M365Mail\Dynamics365\Reader\Base;

use LuzernTourismus\M365Mail\Dynamics365\Config\Dynamics365Config;
use LuzernTourismus\M365Mail\Login\Token\ClientToken;
use Nemundo\Core\Debug\Debug;
use Nemundo\Core\Json\Reader\JsonReader;
use Nemundo\Core\TextFile\Writer\TextFileWriter;
use Nemundo\Core\WebRequest\BearerAuthentication\JsonBearerAuthenticationWebRequest;
use Nemundo\Project\Config\ProjectConfigReader;
use Nemundo\Project\Path\TmpPath;

abstract class AbstractDynamics365Reader
{

    protected $logName;


    protected function getJsonData($endpoint)
    {

        $org = (new ProjectConfigReader())->getValue('dynamics365_org');
        $domain = 'https://' . $org . '.crm4.dynamics.com/';
        $scope = $domain . '.default';

        $client = new ClientToken();
        $client->scope = $scope;
        $token = $client->getToken();

//        $url = $domain . 'api/data/v9.2/lists' . $endpoint;
        $url = $domain . 'api/data/v9.2' . $endpoint;

        $curl = new JsonBearerAuthenticationWebRequest();
        $curl->bearerAuthentication = $token;
        $curl->addHeader('Prefer: odata.include-annotations="OData.Community.Display.V1.FormattedValue"');
        $response = $curl->getUrl($url);

        if (Dynamics365Config::$debugMode) {

            (new Debug())->write($response);

            $filename = (new TmpPath())->addPath('dynamics365_' . $this->logName . '.json')->getFullFilename();

            $file = new TextFileWriter($filename);
            $file->overwriteExistingFile = true;
            $file->addLine($response->html);
            $file->writeFile();

        }

        $jsonReader = new JsonReader();
        $jsonReader->fromText($response->html);
        $json = $jsonReader->getData();

        $valueList = [];
        if (isset($json['value'])) {
            $valueList = $json['value'];
        }

        return $valueList;

    }

}