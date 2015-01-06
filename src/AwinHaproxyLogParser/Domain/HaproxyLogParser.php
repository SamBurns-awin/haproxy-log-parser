<?php
namespace AwinHaproxyLogParser\Domain;

class HaproxyLogParser
{
    protected $logClasses = array('\AwinHaproxyLogParser\Domain\HaproxyTcpLogEntry', '\AwinHaproxyLogParser\Domain\HaproxyHttpLogEntry');

    function __construct()
    {}

    function parse($line) {
        foreach ($this->logClasses as $logClass) {
            if (preg_match($logClass::$regexp, $line, $matches)) {
                array_shift($matches);
                return new $logClass($matches);
            }
        }
    }
}

