<?php

# this class was developed with the help of ChatGPT

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpFoundation\Request;

class ErrorController extends AbstractController
{
    public function show(Request $request, \Throwable $exception): Response
    {
        $statusCode = $exception instanceof HttpExceptionInterface ? $exception->getStatusCode() : 500;

        return $this->render('bundles/TwigBundle/Exception/error.html.twig', [
            'code' => $statusCode,
            'message' => $exception->getMessage(),
        ]);
    }
}