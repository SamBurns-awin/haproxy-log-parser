<?php

require_once __DIR__ . '/../bootstrap.php';

use Silex\Application;
use AwinHaproxyLogParser\Controller\Index as IndexController;
use AwinHaproxyLogParser\Controller\Parse as ParseController;
use Symfony\Component\HttpFoundation\Request;

$application = new Application();

$application->get(
    '/',
    function () {
        $controller = new IndexController();
        return $controller->indexAction();
    }
);

$application->post(
    '/parse/',
    function (Request $request) {
        $controller = new ParseController();
        return $controller->parseAction($request);
    }
);

$application->run();
