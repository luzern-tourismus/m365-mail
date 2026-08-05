<?php

namespace LuzernTourismus\M365Mail\Mail;

use LuzernTourismus\M365Mail\Login\Token\ClientToken;
use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Debug\Debug;
use Nemundo\Core\File\Base64\Base64FileReader;
use Nemundo\Core\File\File;
use Nemundo\Core\Http\Response\StatusCode;
use Nemundo\Core\Json\JsonText;
use Nemundo\Core\WebRequest\BearerAuthentication\JsonBearerAuthenticationWebRequest;

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

        $token = (new ClientToken())->getToken();

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