<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use AwinHaproxyLogParser\Domain\HaproxyLogParser;
use AwinHaproxyLogParser\Domain\HaproxyTcpLogEntry;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    /** @var HaproxyLogParser */
    private $parser;

    /** @var HaproxyTcpLogEntry */
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
        $this->parser = new HaproxyLogParser();
    }

    /**
     * @When I give the log parser the line :lineToParse
     */
    public function iGiveTheLogParserTheLine($lineToParse)
    {
        $this->parsingResult = $this->parser->parse($lineToParse);
    }

    /**
     * @Then The parser should be saying that the date is in February
     */
    public function theParserShouldBeSayingThatTheDateIsInFebruary()
    {
        PHPUnit_Framework_Assert::assertEquals('06/Feb/2009:12:12:51.443', $this->parsingResult->accept_date);
    }
}
