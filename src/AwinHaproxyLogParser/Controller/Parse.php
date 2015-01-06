<?php
namespace AwinHaproxyLogParser\Controller;

use AwinHaproxyLogParser\Domain\HaproxyLogLine\LogLineFactory;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AwinHaproxyLogParser\Domain\HaproxyLogLine\LogLine;
use AwinHaproxyLogParser\Domain\FieldDocumentation\WebFieldDocumentationRetriever;
use AwinHaproxyLogParser\Domain\FieldDocumentation\FieldDocumentationRetrieverCacheDecorator;
use AwinHaproxyLogParser\Domain\FieldDocumentation\FieldDocumentationRetriever;
use AwinHaproxyLogParser\Domain\FieldDocumentation\FieldDocumentation;

class Parse
{
    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function parseAction(Request $request)
    {
        $query = $request->get('query');

        $logLine = $this->getLogLine($query);

        $protocol = $logLine->getDocLabel();

        $fieldDocumentation = $this->getFieldDocumentation();

        $responseBody = '';

        foreach ($logLine->toArray() as $field => $value) {
            $responseBody .= $field . '</br>';
            $responseBody .= $value . '</br>';
            $fieldDocumentationText = $fieldDocumentation->getFieldDocumentation($protocol, $field);

            if (!empty($fieldDocumentationText)) {
                $responseBody .= $fieldDocumentationText . '</br>';
            }
            $responseBody .= '</br>';
        }

        $response = new JsonResponse();
        $response->setContent($responseBody);
        return $response;
    }

    /**
     * @param $logLineString
     * @return LogLine
     */
    private function getLogLine($logLineString)
    {
        $factory = new LogLineFactory();
        return $factory->createLogLine($logLineString);
    }

    /**
     * @return FieldDocumentation
     */
    private function getFieldDocumentation()
    {
        $fieldDocumentationRetriever = $this->getFieldDocumentationRetriever();
        $fieldDocumentation = $fieldDocumentationRetriever->getFieldDocumentation();
        return $fieldDocumentation;
    }

    /**
     * @return FieldDocumentationRetriever
     */
    private function getFieldDocumentationRetriever()
    {
        $webFieldDocumentationRetriever = new WebFieldDocumentationRetriever();
        $cacheDecorator = new FieldDocumentationRetrieverCacheDecorator($webFieldDocumentationRetriever);
        return $cacheDecorator;
    }
}

//$lines[] = 'haproxy[14389]: 10.0.1.2:33317 [06/Feb/2009:12:14:14.655] http-in static/srv1 10/0/30/69/109 200 2750 - - ---- 1/1/1/1/0 0/0 {1wt.eu} {} "GET /index.html HTTP/1.1"';
//$lines[] = 'haproxy[14387]: 10.0.1.2:33313 [06/Feb/2009:12:12:51.443] fnt bck/srv1 0/0/5007 212 -- 0/0/0/0/3 0/0';
