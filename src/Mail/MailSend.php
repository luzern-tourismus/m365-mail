<?php

namespace LuzernTourismus\M365Mail\Mail;

use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Debug\Debug;
use Nemundo\Core\File\Base64\Base64FileReader;
use Nemundo\Core\File\File;
use Nemundo\Core\Http\Response\StatusCode;
use Nemundo\Core\Json\JsonText;
use Nemundo\Core\Json\Reader\JsonReader;
use Nemundo\Core\WebRequest\BearerAuthentication\JsonBearerAuthenticationWebRequest;
use Nemundo\Core\WebRequest\Curl\CurlWebRequest;
use Nemundo\Project\Config\ProjectConfigReader;

class MailSend extends AbstractBase
{

    public $subject;

    public $text;

    public $to;

    public $from;

    public $filenameList = [];

    public function addAttachment($filename)
    {

        $this->filenameList[] = $filename;
        return $this;

    }


    public function send()
    {

        $tenantId = (new ProjectConfigReader())->getValue('m365_tenant_id');
        $applicationId = (new ProjectConfigReader())->getValue('m365_application_id');
        $clientSecret = (new ProjectConfigReader())->getValue('m365_client_secret');

        $tokenUrl = 'https://login.microsoftonline.com/' . $tenantId . '/oauth2/v2.0/token';
        $postData = [
            'client_id' => $applicationId,
            'scope' => 'https://graph.microsoft.com/.default',
            'client_secret' => $clientSecret,
            'grant_type' => 'client_credentials'
        ];

        $tokenRequest = new CurlWebRequest();
        $tokeResponse = $tokenRequest->postUrl($tokenUrl, $postData);

        $tokenJson = (new JsonReader())->fromText($tokeResponse->html)->getData();

        $token = null;
        if (isset($tokenJson['access_token'])) {
            $token = $tokenJson['access_token'];
        } else {
            (new Debug())->write('No valid token');
            (new Debug())->write($tokeResponse);
        }



        $attachmentPayload = [];

        foreach ($this->filenameList as $filename) {

            $file = new File($filename);

            $item = [];
            $item['@odata.type'] = "#microsoft.graph.fileAttachment";
            $item['name'] = $file->getFilename();
            $item['contentType'] = $file->getMimeType();
            //$item['isInline'] = true;
            $item['contentId'] = "header";
            $item['contentBytes'] = (new Base64FileReader($filename))->getBase64();

            $attachmentPayload[] = $item;

        }

        $graphEndpoint = 'https://graph.microsoft.com/v1.0/users/' . $this->from . '/sendMail';
        $payload = [
            "message" => [
                "subject" => $this->subject,
                "body" => [
                    "contentType" => "HTML",
                    "content" => $this->text
                ],
                "toRecipients" => [
                    ["emailAddress" => ["address" => $this->to]]
                ],
                "attachments" => $attachmentPayload
            ],
            "saveToSentItems" => true
        ];

        $request = new JsonBearerAuthenticationWebRequest();
        $request->bearerAuthentication = $token;
        $response = $request->postUrl($graphEndpoint, (new JsonText())->addData($payload)->getJson());

        if ($response->statusCode !== StatusCode::ACCEPTED) {
            (new Debug())->write($response);
        }

    }

}