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
}
