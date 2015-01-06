<?php
namespace AwinHaproxyLogParser\Domain\FieldDocumentation;

class FieldDocumentationRetrieverCacheDecorator implements FieldDocumentationRetriever
{
    /** @var FieldDocumentationRetriever */
    private $nextSource;

    /** @var string */
    private $cacheFile = 'haproxy-doc-cache.json';

    /** @var int */
    private $cacheValidity = 86400;

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
            $this->cache($fieldDocumentation);
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

    /**
     * @param FieldDocumentation $fieldDocumentation
     */
    private function cache(FieldDocumentation $fieldDocumentation)
    {
        file_put_contents($this->cacheFile, json_encode($fieldDocumentation->toArray(), JSON_PRETTY_PRINT));
    }

    /**
     * @return FieldDocumentation
     */
    private function getFromCache()
    {
        $fieldData = json_decode(file_get_contents($this->cacheFile));
        return new FieldDocumentation($fieldData);
    }
}
