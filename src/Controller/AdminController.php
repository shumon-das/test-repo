<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class AdminController
{
    public function admin(): Response
    {
        $first_name = 'mono';
        $last_name = 'ranjan';

        return new Response(sprintf('I am admin %s-%s', $first_name, $last_name));
    }
}
