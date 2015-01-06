<?php
namespace AwinHaproxyLogParser\Domain\HaproxyLogLine;

class LogLineFactory
{
    /** @var string */
    private $httpLogLineRegex = '/(\S+)\[(\d+)\]: ([\d\.]+):(\d+) \[(\S+)\] (\S+) (\S+)\/(\S+) (\d+)\/(\d+)\/(\d+)\/(\d+)\/(\d+) (\d+) (\d+) (\S) (\S) (\S{4}) (\d+)\/(\d+)\/(\d+)\/(\d+)\/(\d+) (\d+)\/(\d+) {(.*?)} {(.*?)} "(.*?)"$/';

    /** @var string */
    private $tcpLogLineRegex = '/(\S+)\[(\d+)\]: ([\d\.]+):(\d+) \[(\S+)\] (\S+) (\S+)\/(\S+) (\d+)\/(\d+)\/(\d+) (\d+) (\S{2}) (\d+)\/(\d+)\/(\d+)\/(\d+)\/(\d+) (\d+)\/(\d+)$/';

    /**
     * @param $lineAsText
     * @return LogLine
     */
    public function createLogLine($lineAsText)
    {
        $regexMatches = array();

        if (preg_match($this->httpLogLineRegex, $lineAsText, $regexMatches)) {
            array_shift($regexMatches);
            return new HttpLogLine($regexMatches);
        }

        if (preg_match($this->tcpLogLineRegex, $lineAsText, $regexMatches)) {
            array_shift($regexMatches);
            return new TcpLogLine($regexMatches);
        }

        throw new \InvalidArgumentException('Don\'t know what to do with input line');
    }
}
