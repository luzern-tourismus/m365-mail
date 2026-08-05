<?php

namespace LuzernTourismus\M365Mail\Graph\Request;

use LuzernTourismus\M365Mail\Graph\Config\GraphConfig;
use LuzernTourismus\M365Mail\Login\Token\ClientToken;
use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Debug\Debug;
use Nemundo\Core\Json\Reader\JsonReader;
use Nemundo\Core\TextFile\Writer\TextFileWriter;
use Nemundo\Core\WebRequest\BearerAuthentication\JsonBearerAuthenticationWebRequest;
use Nemundo\Project\Path\TmpPath;

class GraphRequest extends AbstractBase
{

    public function getData($endpoint)
    {

        $url = 'https://graph.microsoft.com/v1.0/' . $endpoint;

        $token = (new ClientToken())->getToken();

        $request = new JsonBearerAuthenticationWebRequest();
        $request->bearerAuthentication = $token;
        $response = $request->getUrl($url);

        //(new \Nemundo\Core\Debug\Debug())->write($response);

        if (GraphConfig::$debugMode) {

            $filename = (new TmpPath())->addPath('graph.json')->getFullFilename();

            $file = new TextFileWriter($filename);
            $file->overwriteExistingFile = true;
            $file->addLine($response->html);
            $file->writeFile();

        }

        $json = (new JsonReader())->fromText($response->html)->getData();

        if (isset($json['error'])) {

            $errorCode = $json['error']['code'];
            $errorMessage = $json['error']['message'];

            (new Debug())->write($errorMessage);

        }

        $valueList = [];
        if (isset($json['value'])) {
            $valueList = $json['value'];
        }

        return $valueList;

    }

}