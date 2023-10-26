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

    private float $interimResult;

    private ?Throwable $lastException = null;

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
     * @Transform /^(-?\d+\.*\d*)$/
     */
    public function castStringToFloat(string $string): float
    {
        return floatval($string);
    }

    /**
     * @Given /I have a number (-?\d+\.*\d*)/
     */
    public function iHaveANumber(float $numberOne): void
    {
        $this->interimResult = $numberOne;
    }

    /**
     * @When /I add to (?:the first number|the result) the number (-?\d+\.*\d*)/
     */
    public function addToResult($number): void 
    {
        try {
            $this->interimResult = $this->calcService->addition($this->interimResult, $number);
        } catch (Throwable $e) {
            $this->lastException = $e;
        }
    }

    /**
     * @When /I divide (?:the first number|the result) by the number (-?\d+\.*\d*)/
     */
    public function divideResultBy($number): void 
    {
        try {
            $this->interimResult = $this->calcService->division($this->interimResult, $number);
        } catch (DivisionByZeroError $e) {
            $this->lastException = $e;
        }
    }

    /**
     * @When /I multiply (?:the first number|the result) by the number (-?\d+\.*\d*)/
     */
    public function multiplyResultBy($number): void
    {
        try {
            $this->interimResult = $this->calcService->multiplication($this->interimResult, $number);
        } catch (Throwable $e) {
            $this->lastException = $e;
        }
    }

    /**
     * @When /I subtract from (?:the first number|the result) the number (-?\d+\.*\d*)/
     */
    public function subtractFromResult($number): void
    {
        try {
            $this->interimResult = $this->calcService->subtraction($this->interimResult, $number);
        } catch (Throwable $e) {
            $this->lastException = $e;
        }
    }

    /**
     * @Then /the (?:quotient|sum|difference|product|result) should be (-?\d+\.*\d*)/
     */
    public function theResultShouldBe(float $estimatedResult): bool
    {
        if ($this->interimResult === $estimatedResult) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @Then no exception should have been thrown
     */
    public function noExceptionShouldHaveBeenThrown(): bool
    {
        if ($this->lastException === null) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @Then a division by zero error message should be thrown
     */
    public function aDivisionByZeroErrorMessageShouldBeThrown(): bool
    {
        return is_a($this->lastException, DivisionByZeroError::class);
    }

}
