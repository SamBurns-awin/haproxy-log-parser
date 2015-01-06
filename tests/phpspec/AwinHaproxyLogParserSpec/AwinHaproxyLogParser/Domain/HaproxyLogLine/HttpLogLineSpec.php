<?php
namespace AwinHaproxyLogParserSpec\AwinHaproxyLogParser\Domain\HaproxyLogLine;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HttpLogLineSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('haproxy[14389]: 10.0.1.2:33317 [06/Feb/2009:12:14:14.655] http-in static/srv1 10/0/30/69/109 200 2750 - - ---- 1/1/1/1/0 0/0 {1wt.eu} {} "GET /index.html HTTP/1.1"');
    }

    function it_knows_what_the_fields_mean()
    {
        $this->getFieldByName('http_request')->shouldReturn('GET /index.html HTTP/1.1');
    }
}
