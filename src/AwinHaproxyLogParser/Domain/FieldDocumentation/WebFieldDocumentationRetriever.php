<?php
namespace AwinHaproxyLogParser\Domain\FieldDocumentation;

class WebFieldDocumentationRetriever implements FieldDocumentationRetriever
{
    /** @var string */
    private $docUrl = 'https://raw.githubusercontent.com/langpavel/haproxy-doc/master/version-1-5/configuration.txt';

    /**
     * @throws \Exception
     *
     * @return FieldDocumentation
     */
    public function getFieldDocumentation()
    {
        $fieldData = array();
        $doc = file_get_contents($this->docUrl);

        // HTTP log fields
        if(! preg_match_all('/8.2.3. HTTP log format.*?\nDetailed fields description :\n(.*?)\n8.3. /s', $doc, $matches)) {
            throw new \Exception("Couldn't find HTTP log format section");
        }
        $fieldData['http'] = $this->extractFields($matches[1][0]);

        // TCP log format
        if(! preg_match_all('/8.2.2. TCP log format.*?\nDetailed fields description :\n(.*?)\n8.2.3. /s', $doc, $matches)) {
            throw new \Exception("Couldn't find TCP log format section");
        }
        $fieldData['tcp'] = $this->extractFields($matches[1][0]);

        return new FieldDocumentation($fieldData);
    }

    /**
     * @param string $text
     * @return string[]
     */
    private function extractFields($text)
    {
        preg_match_all('/  - "(.*?)" (.*?)\n\n/s', $text, $matches);
        array_shift($matches);

        // re-key output
        $out = array();
        for ($i=0; $i<count($matches[0]); $i++) {
            $out[ $matches[0][$i] ] = preg_replace('/\s+/', " ", $matches[1][$i]);
        }
        return $out;
    }
}
