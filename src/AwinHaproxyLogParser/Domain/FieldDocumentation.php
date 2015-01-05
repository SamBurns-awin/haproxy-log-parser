<?php
namespace AwinHaproxyLogParser\Domain;

class FieldDocumentation
{
    protected $docUrl = 'https://raw.githubusercontent.com/langpavel/haproxy-doc/master/version-1-5/configuration.txt';
    protected $cacheFile = 'haproxy-doc-cache.json';
    protected $cacheValidity = 86400;

    function __construct()
    {
        // qualify the cache file location
        $this->cacheFile = sys_get_temp_dir() . DIRECTORY_SEPARATOR . $this->cacheFile;
    }

    protected function cacheNeedsRefreshing()
    {
        // cache is missing
        if (!file_exists($this->cacheFile)) {
            return true;
        }
        // cache is stale
        if (time() - filemtime($this->cacheFile) > $this->cacheValidity) {
            return true;
        }
        // must be good
        return false;
    }

    protected function buildCacheFile()
    {
        $fieldData = array();
        $doc = file_get_contents($this->docUrl);

        // HTTP log fields
        if(! preg_match_all('/8.2.3. HTTP log format.*?\nDetailed fields description :\n(.*?)\n8.3. /s', $doc, $matches)) {
            throw new Exception("Couldn't find HTTP log format section");
        }
        $fieldData['http'] = $this->extractFields($matches[1][0]);

        // TCP log format
        if(! preg_match_all('/8.2.2. TCP log format.*?\nDetailed fields description :\n(.*?)\n8.2.3. /s', $doc, $matches)) {
            throw new Exception("Couldn't find TCP log format section");
        }
        $fieldData['tcp'] = $this->extractFields($matches[1][0]);

        // render it out as a JSON file
        file_put_contents($this->cacheFile, json_encode($fieldData, JSON_PRETTY_PRINT));
    }

    function extractFields($text)
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

    protected function readCacheFile()
    {
        $fieldData = json_decode(file_get_contents($this->cacheFile));
        $this->tcp = $fieldData->tcp;
        $this->http = $fieldData->http;
    }

    function load()
    {
        if ($this->cacheNeedsRefreshing()) {
            $this->buildCacheFile();
        }
        $this->readCacheFile();
    }
}
