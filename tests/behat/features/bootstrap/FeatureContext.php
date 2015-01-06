<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use AwinHaproxyLogParser\Domain\HaproxyLogLine\LogLineFactory;
use AwinHaproxyLogParser\Domain\HaproxyLogLine\LogLine;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    /** @var LogLineFactory */
    private $parser;

    /** @var LogLine */
    private $parsingResult;

    public function __construct()
    {
        require_once __DIR__ . '/../../../../bootstrap.php';
    }

    /**
     * @Given I have a log parser
     */
    public function iHaveALogParser()
    {
        $this->parser = new LogLineFactory();
    }

    /**
     * @When I give the log parser the line of HTTP log :arg2
     */
    public function iGiveTheLogParserTheLineOfHttpLog($lineToParse)
    {
        $this->parsingResult = $this->parser->createLogLine($lineToParse);
    }

    /**
     * @Then The parser should be saying that the date is in February
     */
    public function theParserShouldBeSayingThatTheDateIsInFebruary()
    {
        \PHPUnit_Framework_Assert::assertEquals('06/Feb/2009:12:14:14.655', $this->parsingResult->getFieldByName('accept_date'));
    }
}
