<?php

require_once __DIR__ . '/../bootstrap.php';

use Silex\Application;
use AwinHaproxyLogParser\Controller\Index as IndexController;
use AwinHaproxyLogParser\Controller\Parse as ParseController;
use Symfony\Component\HttpFoundation\Request;
use Silex\Provider\TwigServiceProvider;

$application = new Application();

$twigServiceProvider = new TwigServiceProvider();
$application->register($twigServiceProvider, array('twig.path' => APPLICATION_ROOT_DIR . '/view/'));
$twigEnvironment = $application['twig'];

$application->get(
    '/haproxy-log-parser.css',
    function () {
        return file_get_contents(APPLICATION_ROOT_DIR . '/public/haproxy-log-parser.css');
    }
);

$application->get(
    '/',
    function () use ($twigEnvironment) {
        $controller = new IndexController();
        return $controller->indexAction($twigEnvironment);
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
