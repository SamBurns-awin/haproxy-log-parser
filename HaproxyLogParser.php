<?php

require('HaproxyTcpLogEntry.php');
require('HaproxyHttpLogEntry.php');

class HaproxyLogParser
{
    protected $logClasses = array('HaproxyTcpLogEntry', 'HaproxyHttpLogEntry');

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

