<?php
namespace AwinHaproxyLogParser\Controller;

use AwinHaproxyLogParser\Domain\FieldDocumentation\FieldDocumentation;
use AwinHaproxyLogParser\Domain\HaproxyLogLine\LogLineFactory;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AwinHaproxyLogParser\Domain\FieldDocumentation\FieldDocumentationRetriever;
use Twig_Environment as TwigEnvironment;
use AwinHaproxyLogParser\Domain\HaproxyLogLine\LogLine;

class Parse
{
    /** @var TwigEnvironment */
    private $twigEnvironment;

    /** @var FieldDocumentationRetriever */
    private $fieldDocumentationRetriever;

    /** @var LogLineFactory */
    private $logLineFactory;

    /**
     * @param TwigEnvironment             $twigEnvironment
     * @param FieldDocumentationRetriever $fieldDocumentationRetriever
     * @param LogLineFactory              $logLineFactory
     */
    public function __construct(
        TwigEnvironment             $twigEnvironment,
        FieldDocumentationRetriever $fieldDocumentationRetriever,
        LogLineFactory              $logLineFactory
    ) {
        $this->twigEnvironment             = $twigEnvironment;
        $this->fieldDocumentationRetriever = $fieldDocumentationRetriever;
        $this->logLineFactory              = $logLineFactory;
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function parseAction(Request $request)
    {
        $logLine = $this->createLogLineObjectFromRequest($request);

        $protocol = $logLine->getDocLabel();

        $fieldDocumentation = $this->fieldDocumentationRetriever->getFieldDocumentation();

        $results = $this->createDisplayableResults($logLine, $fieldDocumentation, $protocol);

        $content = $this->twigEnvironment->render('results.twig', array('fieldList' => $results));

        $response = new JsonResponse();
        $response->setContent($content);
        return $response;
    }

    /**
     * @param Request $request
     * @return LogLine
     */
    private function createLogLineObjectFromRequest(Request $request)
    {
        $query = $request->get('query');
        return $this->logLineFactory->createLogLine($query);
    }

    /**
     * @param LogLine            $logLine
     * @param FieldDocumentation $fieldDocumentation
     * @param string             $protocol
     *
     * @return array
     */
    private function createDisplayableResults(LogLine $logLine, FieldDocumentation $fieldDocumentation, $protocol)
    {
        $results = array();

        foreach ($logLine->toArray() as $field => $value) {
            $result = array();
            $result['title']         = $field;
            $result['value']         = $value;
            $result['documentation'] = $fieldDocumentation->getFieldDocumentation($protocol, $field);
            $results[] = $result;
        }

        return $results;
    }
}

//$lines[] = 'haproxy[14389]: 10.0.1.2:33317 [06/Feb/2009:12:14:14.655] http-in static/srv1 10/0/30/69/109 200 2750 - - ---- 1/1/1/1/0 0/0 {1wt.eu} {} "GET /index.html HTTP/1.1"';
//$lines[] = 'haproxy[14387]: 10.0.1.2:33313 [06/Feb/2009:12:12:51.443] fnt bck/srv1 0/0/5007 212 -- 0/0/0/0/3 0/0';
