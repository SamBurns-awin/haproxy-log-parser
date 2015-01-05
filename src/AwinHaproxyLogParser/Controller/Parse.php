<?php
namespace AwinHaproxyLogParser\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class Parse
{
    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function parseAction(Request $request)
    {
        $response = new JsonResponse();
        $response->setContent('hello world');
        return $response;
    }
}
