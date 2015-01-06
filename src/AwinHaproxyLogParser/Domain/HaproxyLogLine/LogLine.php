<?php
namespace AwinHaproxyLogParser\Domain\HaproxyLogLine;

interface LogLine
{
    /**
     * @param string $fieldName
     */
    public function getFieldByName($fieldName);
}
