<?php

namespace App\Features\Task\Http\Controllers;

use App\support\View;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeController
{
    public function index(Request $request, Response $response)
    {
        return View::render('home', [], $response);
    }
}
