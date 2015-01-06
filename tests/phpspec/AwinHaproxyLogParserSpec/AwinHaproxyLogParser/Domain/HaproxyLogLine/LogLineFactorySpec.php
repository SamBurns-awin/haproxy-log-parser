<?php
namespace AwinHaproxyLogParserSpec\AwinHaproxyLogParser\Domain\HaproxyLogLine;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LogLineFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('AwinHaproxyLogParser\Domain\HaproxyLogLine\LogLineFactory');
    }

    function it_can_create_log_line()
    {
        $this
            ->createLogLine('haproxy[14389]: 10.0.1.2:33317 [06/Feb/2009:12:14:14.655] http-in static/srv1 10/0/30/69/109 200 2750 - - ---- 1/1/1/1/0 0/0 {1wt.eu} {} "GET /index.html HTTP/1.1"')
            ->shouldBeAnInstanceOf('\AwinHaproxyLogParser\Domain\HaproxyLogLine\LogLine');
    }

    function it_can_create_an_http_log_line()
    {
        $this
            ->createLogLine('haproxy[14389]: 10.0.1.2:33317 [06/Feb/2009:12:14:14.655] http-in static/srv1 10/0/30/69/109 200 2750 - - ---- 1/1/1/1/0 0/0 {1wt.eu} {} "GET /index.html HTTP/1.1"')
            ->shouldBeAnInstanceOf('\AwinHaproxyLogParser\Domain\HaproxyLogLine\HttpLogLine');
    }

    function it_can_create_a_tcp_log_line()
    {
        $this
            ->createLogLine('haproxy[14387]: 10.0.1.2:33313 [06/Feb/2009:12:12:51.443] fnt bck/srv1 0/0/5007 212 -- 0/0/0/0/3 0/0')
            ->shouldBeAnInstanceOf('\AwinHaproxyLogParser\Domain\HaproxyLogLine\TcpLogLine');
    }
}
