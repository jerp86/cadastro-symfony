<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class DefaultController
{
    public function index()
    {
        $resp = new Response();
        
        $resp->setContent('#DIO - Dgital Innovation One');
        $resp->setStatusCode(200);

        return $resp;
    }
}