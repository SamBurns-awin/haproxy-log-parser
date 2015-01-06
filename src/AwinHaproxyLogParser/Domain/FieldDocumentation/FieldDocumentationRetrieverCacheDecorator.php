<?php
namespace AwinHaproxyLogParser\Domain\FieldDocumentation;

class FieldDocumentationRetrieverCacheDecorator implements FieldDocumentationRetriever
{
    /** @var FieldDocumentationRetriever */
    private $nextSource;

    /** @var string */
    private $cacheFilename = 'haproxy-doc-cache.json';

    /** @var int */
    private $cacheValidity = 1; //86400;

    /**
     * @param FieldDocumentationRetriever $fieldDocumentationRetriever
     */
    public function __construct(FieldDocumentationRetriever $fieldDocumentationRetriever)
    {
        $this->nextSource = $fieldDocumentationRetriever;
    }

    /**
     * @return FieldDocumentation
     */
    public function getFieldDocumentation()
    {
        if ($this->cacheNeedsRefreshing()) {
            $fieldDocumentation = $this->nextSource->getFieldDocumentation();
            $this->writeToCache($fieldDocumentation);
        } else {
            $fieldDocumentation = $this->getFromCache();
        }

        return $fieldDocumentation;
    }

    /**
     * @return bool
     */
    private function cacheNeedsRefreshing()
    {
        return !$this->cacheIsMissing() && !$this->cacheIsStale();
    }

    /**
     * @return bool
     */
    private function cacheIsMissing()
    {
        return !file_exists($this->getCacheFilePath());
    }

    /**
     * @return bool
     */
    private function cacheIsStale()
    {
        return time() - filemtime($this->getCacheFilePath()) > $this->cacheValidity;
    }

    /**
     * @return string
     */
    private function getCacheFilePath()
    {
        return sys_get_temp_dir() . DIRECTORY_SEPARATOR . $this->cacheFilename;
    }

    /**
     * @param FieldDocumentation $fieldDocumentation
     */
    private function writeToCache(FieldDocumentation $fieldDocumentation)
    {
        file_put_contents($this->getCacheFilePath(), json_encode($fieldDocumentation->toArray(), JSON_PRETTY_PRINT));
    }

    /**
     * @return FieldDocumentation
     */
    private function getFromCache()
    {
        $fieldData = json_decode(file_get_contents($this->getCacheFilePath()), true);
        return new FieldDocumentation($fieldData);
    }
}
