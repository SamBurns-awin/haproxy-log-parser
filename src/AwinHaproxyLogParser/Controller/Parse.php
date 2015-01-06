<?php
namespace AwinHaproxyLogParser\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AwinHaproxyLogParser\Domain\FieldDocumentation;
use AwinHaproxyLogParser\Domain\HaproxyLogParser;

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

        $doc = new FieldDocumentation();
        $doc->load();

        $responseBody = '';

        $parser = new HaproxyLogParser();
        $logEntry = $parser->parse($query);
        foreach ($logEntry as $field => $value) {
            $responseBody .= $field . '</br>';
            $responseBody .= $value . '</br>';
            if (!empty($doc->{$logEntry::$docLabel}->$field)) {
                $responseBody .= $doc->{$logEntry::$docLabel}->$field . '</br>';
            }
            $responseBody .= '</br>';
        }

        $response = new JsonResponse();
        $response->setContent($responseBody);
        return $response;
    }
}

//$lines[] = 'haproxy[14389]: 10.0.1.2:33317 [06/Feb/2009:12:14:14.655] http-in static/srv1 10/0/30/69/109 200 2750 - - ---- 1/1/1/1/0 0/0 {1wt.eu} {} "GET /index.html HTTP/1.1"';
//$lines[] = 'haproxy[14387]: 10.0.1.2:33313 [06/Feb/2009:12:12:51.443] fnt bck/srv1 0/0/5007 212 -- 0/0/0/0/3 0/0';
