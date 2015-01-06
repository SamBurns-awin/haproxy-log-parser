<?php
namespace AwinHaproxyLogParser\Domain\FieldDocumentation;

class FieldDocumentation
{
    /** @var array */
    private $fieldDocumentationArray = array();

    /**
     * @param $fieldDocumentationArray
     */
    public function __construct($fieldDocumentationArray)
    {
        $this->fieldDocumentationArray = $fieldDocumentationArray;
    }

    /**
     * @param string $protocol   One of FieldDocumentationRetriever::HTTP, FieldDocumentationRetriever::TCP
     * @param string $fieldName
     *
     * @return string
     */
    public function getFieldDocumentation($protocol, $fieldName)
    {
        return
            isset($this->fieldDocumentationArray[$protocol][$fieldName]) ?
            $this->fieldDocumentationArray[$protocol][$fieldName] :
            'No documentation available';
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->fieldDocumentationArray;
    }
}
