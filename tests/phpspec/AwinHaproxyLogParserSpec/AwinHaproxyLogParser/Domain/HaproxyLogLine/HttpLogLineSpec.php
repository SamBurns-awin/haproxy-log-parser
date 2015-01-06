<?php
namespace AwinHaproxyLogParserSpec\AwinHaproxyLogParser\Domain\HaproxyLogLine;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HttpLogLineSpec extends ObjectBehavior
{
    function let()
    {
        $sampleLine = array('', '', '', '', '', '', '', '', '', '',  '', '', '', '',  '', '', '', '', '', '', '', '', '',  '', '', '', '', 'GET /index.html HTTP/1.1');

        $this->beConstructedWith($sampleLine);
    }

    function it_knows_what_the_fields_mean()
    {
        $this->getFieldByName('http_request')->shouldReturn('GET /index.html HTTP/1.1');
    }
}
