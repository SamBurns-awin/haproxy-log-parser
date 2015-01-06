<?php

require_once __DIR__ . '/../bootstrap.php';

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Silex\Provider\TwigServiceProvider;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\ContainerBuilder as ServiceContainer;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;
use Twig_Environment as TwigEnvironment;



$serviceContainer = getServiceContainer();
$application      = getApplicationObject();
$twigEnvironment  = getTwigEnvironment($application);
$serviceContainer->set('twig-environment', $twigEnvironment);

addRegularRoutesToApplication($application, $serviceContainer);
addErrorControllerToApplication($application);

$application->run();



/**
 * @return ServiceContainer
 */
function getServiceContainer()
{
    $serviceContainer = new ServiceContainer();
    $loader = new YamlFileLoader($serviceContainer, new FileLocator(APPLICATION_ROOT_DIR . '/config/'));
    $loader->load('di.yml');
    return $serviceContainer;
}

/**
 * @return Application
 */
function getApplicationObject()
{
    return new Application();
}

/**
 * @param Application $application
 *
 * @return TwigEnvironment
 */
function getTwigEnvironment(Application $application)
{
    $twigServiceProvider = new TwigServiceProvider();
    $application->register($twigServiceProvider, array('twig.path' => APPLICATION_ROOT_DIR . '/view/'));
    $twigEnvironment = $application['twig'];
    return $twigEnvironment;
}

/**
 * @param Application      $application
 * @param ServiceContainer $serviceContainer
 */
function addRegularRoutesToApplication(Application $application, ServiceContainer $serviceContainer)
{
    $routes = array(
        array('get',  '/',       'controller.index',         'indexAction'),
        array('post', '/parse/', 'controller.parse',         'parseAction'),
        array('get',  'static',  'controller.static-assets', 'serveAction'),
    );

    foreach ($routes as $route) {

        $requestType    = $route[0];
        $routePath      = $route[1];
        $controllerName = $route[2];
        $actionName     = $route[3];

        $application->$requestType(
            $routePath,
            function (Request $request) use ($serviceContainer, $controllerName, $actionName) {
                $controller = $serviceContainer->get($controllerName);
                return $controller->$actionName($request);
            }
        );
    }
}

/**
 * @param Application $application
 */
function addErrorControllerToApplication(Application $application)
{
    $application->error(
        function (Exception $e, $code) {
            $content = var_export(array($e->getMessage(), $e->getTrace()), true);
            return new Response($content);
        }
    );
}
