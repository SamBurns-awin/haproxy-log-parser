<?php
namespace AwinHaproxyLogParser\Domain\HaproxyLogLine;

interface LogLine
{
    /**
     * @param string $fieldName
     *
     * @return string
     */
    public function getFieldByName($fieldName);

    /**
     * @return string[]
     */
    public function toArray();

    /**
     * @return string
     */
    public function getDocLabel();
}
