<?php
namespace AwinHaproxyLogParser\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class StaticAssets
{
    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function serveAction(Request $request)
    {
        $filename = $request->get('filename');
        $content = $this->getStaticFileContents($filename);

        $response = new JsonResponse();
        $response->setContent($content);
        return $response;
    }

    /**
     * @param string $filename
     *
     * @return string
     */
    private function getStaticFileContents($filename)
    {
        return file_get_contents(APPLICATION_ROOT_DIR . '/public/' . $filename);
    }
}
