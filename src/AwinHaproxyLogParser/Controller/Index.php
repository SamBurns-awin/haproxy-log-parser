<?php
namespace AwinHaproxyLogParser\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig_Environment as TwigEnvironment;

class Index
{
    /** @var TwigEnvironment */
    private $twigEnvironment;

    /**
     * @param TwigEnvironment $twigEnvironment
     */
    public function __construct(TwigEnvironment $twigEnvironment)
    {
        $this->twigEnvironment = $twigEnvironment;
    }

    /**
     * @return Response
     */
    public function indexAction()
    {
        $content = $this->twigEnvironment->render('index.twig');

        $response = new Response();
        $response->setContent($content);
        return $response;
    }
}
