<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Netlogix\PhpUnit\Service\CalcService;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    private CalcService $calcService;
    private float $firstNumber;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->calcService = new CalcService();
    }

    /**
     * @Transform /^(\d+\.*\d*)$/
     */
    public function castStringToFloat(string $string): float
    {
        return floatval($string);
    }

    /**
     * @Given /^I have (\d+\.*\d*)$/
     */
    public function iHave(float $numberOne)
    {
         $this->firstNumber = $numberOne;
    }

    /**
     * @When I add :numberTwo
     */
    public function iAdd($numberTwo)
    {
        throw new PendingException();
    }

    /**
     * @Then the sum should be :sum
     */
    public function theSumShouldBe($sum)
    {
        throw new PendingException();
    }



    /**
     * @When I subtract a :arg1
     */
    public function iSubtractA($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then the difference should be :difference
     */
    public function theDifferenceShouldBe($difference)
    {
        throw new PendingException();
    }

    /**
     * @When I multiply it by a :arg1
     */
    public function iMultiplyItByA($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then the product should be :arg1
     */
    public function theProductShouldBe($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When I divide it by a :arg1
     */
    public function iDivideItByA($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When this :arg1 is not :arg2
     */
    public function thisIsNot($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Then the quotient should be :arg1
     */
    public function theQuotientShouldBe($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When I divide it by a <numberTwo>
     */
    public function iDivideItByASecondNumber()
    {
        throw new PendingException();
    }

    /**
     * @When this <numberTwo> is :arg1
     */
    public function thisSecondNumberIs($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then a division by zero error message should be thrown
     */
    public function anDivisionByZeroErrorMessageShouldBeThrown()
    {
        throw new PendingException();
    }

    /**
     * @Given /^I have (.*)$/
     */
    public function iHave($numberOne)
    {
        throw new PendingException();
    }

}
