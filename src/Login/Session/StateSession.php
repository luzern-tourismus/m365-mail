<?php

namespace LuzernTourismus\M365Mail\Login\Session;

use Nemundo\Core\Http\Session\AbstractSession;

class StateSession extends AbstractSession
{

    protected function loadSession()
    {

        $this->sessionName = 'oauth_state';

    }

}