<?php

namespace App\support;

use Psr\Http\Message\ResponseInterface;
use Slim\Views\PhpRenderer;
use Throwable;

class View
{
    /**
     * Renders a view.
     *
     * @param  string  $template
     * @param  array  $data
     * @return ResponseInterface
     * @throws Throwable
     */
    public static function render(string $template, array $data = [], $response = null)
    {
        return (new PhpRenderer(__DIR__.'/../resources/views'))
            ->render($response, "$template.php", $data);
    }
}
