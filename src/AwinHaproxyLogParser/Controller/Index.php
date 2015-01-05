<?php
namespace AwinHaproxyLogParser\Controller;

use Symfony\Component\HttpFoundation\Response;

class Index
{
    /**
     * @return Response
     */
    public function indexAction()
    {
        $response = new Response();
        $response->setContent('hello world');
        return $response;
    }
}
