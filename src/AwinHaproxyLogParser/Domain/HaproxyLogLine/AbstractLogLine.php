<?php
namespace AwinHaproxyLogParser\Domain\HaproxyLogLine;

abstract class AbstractLogLine implements LogLine
{
    /** @var string[] */
    private $logLineAssocArray = array();

    /**
     * @param string[] $logLineAsNumericalArray
     */
    public function __construct($logLineAsNumericalArray)
    {
        $logLineArrayKeys = $this->getFieldNames();

        foreach ($logLineAsNumericalArray as $logLineField) {
            $this->logLineAssocArray[array_shift($logLineArrayKeys)] = $logLineField;
        }
    }

    /**
     * @param string $fieldName
     *
     * @return string
     */
    public function getFieldByName($fieldName)
    {
        return $this->logLineAssocArray[$fieldName];
    }

    /**
     * @return string[]
     */
    abstract protected function getFieldNames();

    /**
     * @return string[]
     */
    public function toArray()
    {
        return $this->logLineAssocArray;
    }

    /**
     * @return string
     */
    abstract public function getDocLabel();
}
