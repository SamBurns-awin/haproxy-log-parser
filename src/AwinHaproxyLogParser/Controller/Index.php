<?php
namespace AwinHaproxyLogParser\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig_Environment as TwigEnvironment;

class Index
{
    /**
     * @return Response
     */
    public function indexAction(TwigEnvironment $twigEnvironment)
    {
        $content = $twigEnvironment->render('index.twig');

        $response = new Response();
        $response->setContent($content);
        return $response;
    }
}
