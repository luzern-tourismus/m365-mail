<?php

namespace LuzernTourismus\M365Mail\Mail;

use LuzernTourismus\M365Mail\Login\Token\ClientToken;
use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Debug\Debug;
use Nemundo\Core\File\Base64\Base64FileReader;
use Nemundo\Core\File\File;
use Nemundo\Core\Http\Response\StatusCode;
use Nemundo\Core\Json\JsonText;
use Nemundo\Core\Json\Reader\JsonReader;
use Nemundo\Core\WebRequest\BearerAuthentication\JsonBearerAuthenticationWebRequest;

class MailSend extends AbstractBase
{

    public $subject;

    public $text;

    public $to;

    public $from;

    private $filenameList = [];

    private $inlineImageList = [];


    public function addAttachment($filename)
    {

        $this->filenameList[] = $filename;
        return $this;

    }


    public function addInlineImage($filename,$contentId)
    {

        $this->inlineImageList[] = [$filename,$contentId];
        return $this;

    }



/*
{
"@odata.type": "#microsoft.graph.fileAttachment",
"name": "logo.png",
"contentType": "image/png",
"contentBytes": "BASE64_STRING_DES_BILDES",
"isInline": true,
"contentId": "logo123"
}*/




    public function send()
    {

        $token = (new ClientToken())->getToken();

        $attachmentPayload = [];

        foreach ($this->filenameList as $filename) {

            $file = new File($filename);

            $item = [];
            $item['@odata.type'] = "#microsoft.graph.fileAttachment";
            $item['name'] = $file->getFilename();
            $item['contentType'] = $file->getMimeType();
            $item['contentId'] = "header";
            $item['contentBytes'] = (new Base64FileReader($filename))->getBase64();

            $attachmentPayload[] = $item;

        }


        foreach ($this->inlineImageList as $inlineImage) {

            $filename = $inlineImage[0];

            $file = new File($filename);

            $item = [];
            $item['@odata.type'] = "#microsoft.graph.fileAttachment";
            $item['name'] = $file->getFilename();
            $item['contentType'] = $file->getMimeType();
            $item['isInline'] = true;
            $item['contentId'] = $inlineImage[1];
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

        if ($response->statusCode === StatusCode::ACCEPTED) {
        }

        //if ($response->statusCode === StatusCode::BAD_REQUEST) {}


        if ($response->statusCode !== StatusCode::ACCEPTED) {

            $json = (new JsonReader())->fromText($response->html)->getData();

            if (isset($json['error'])) {

                (new Debug())->write($json['error']['code']);
                (new Debug())->write($json['error']['message']);


            }


            //(new Debug())->write($response);



        }




    }

}