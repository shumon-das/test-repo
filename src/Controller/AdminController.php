<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class AdminController
{
    public function admin(): Response
    {
        return new Response('I am admin');
    }
}
