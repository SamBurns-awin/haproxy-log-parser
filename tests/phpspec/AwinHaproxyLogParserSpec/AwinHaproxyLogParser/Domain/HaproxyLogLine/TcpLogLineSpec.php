<?php
namespace AwinHaproxyLogParserSpec\AwinHaproxyLogParser\Domain\HaproxyLogLine;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TcpLogLineSpec extends ObjectBehavior
{
    function let()
    {
        $sampleLine = array('process_name', '', '', '', '', '', '', '', '', '',  '', '', '', '',  '', '', '', '', '', '');

        $this->beConstructedWith($sampleLine);
    }

    function it_knows_what_the_fields_mean()
    {
        $this->getFieldByName('process_name')->shouldReturn('process_name');
    }
}
