<?php
namespace AwinHaproxyLogParser\Domain\FieldDocumentation;

interface FieldDocumentationRetriever
{
    const HTTP = 'http';
    const TCP  = 'tcp';

    /**
     * @return FieldDocumentation
     */
    public function getFieldDocumentation();
}
