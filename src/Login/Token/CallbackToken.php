<?php

namespace LuzernTourismus\M365Mail\Login\Token;

use LuzernTourismus\M365Mail\Login\Session\StateSession;
use Nemundo\Project\Config\ProjectConfigReader;

class CallbackToken extends AbstractToken
{

    /*public $tenantId;

    public $applicationId;

    public $clientSecret;

    public $redirectUri;*/


    protected function loadToken()
    {

        $this->grantType = 'authorization_code';

    }


    protected function loadData($postData)
    {


        //(new Debug())->write($_GET);

        $code = $_GET['code'];
        $state = $_GET['state'];


        //$returned = $_GET['state'] ?? '';
        //$state = $_SESSION['oauth_state'] ?? '';

// zeitkonstanter Vergleich, und Einmal-Verwendung
        //if ($expected === '' || !hash_equals($expected, $returned)) {
        if (new StateSession()->getValue() !== $state) {
            http_response_code(400);
            exit('Invalid OAuth state');
        }
        //unset($_SESSION['oauth_state']); // nach Gebrauch entwerten (Replay-Schutz)

        new StateSession()->deleteSession();




        //$postData['grant_type'] = 'authorization_code';
        $postData['code'] = $code;
        $postData['redirect_uri'] = $this->redirectUri;

        return $postData;

    }


    /*public function getToken()
    {

        /*if ($this->redirectUri === null) {
            $this->redirectUri = (new ProjectConfigReader())->getValue('m365_sso_redirect_uri');
        }*/

      /*  return parent::getToken();

    }*/

}