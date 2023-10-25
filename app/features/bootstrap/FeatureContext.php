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

    private float $calculatedResult;

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
        $this->firstNumber = $numberOne;
    }

    /**
     * @When /I add a second number (-?\d+\.*\d*) to the first number/
     */
    public function iAddSecondToFirst($numberTwo): void
    {
        $this->calculatedResult = $this->calcService->addition($this->firstNumber, $numberTwo);
    }

    /**
     * @When /I subtract a second number (-?\d+\.*\d*) from the first number/
     */
    public function iSubtractSecondFromFirst($numberTwo): void
    {
        $this->calculatedResult = $this->calcService->subtraction($this->firstNumber, $numberTwo);
    }

    /**
     * @When /I multiply the first number by a second number (-?\d+\.*\d*)/
     */
    public function iMultiplyFirstBySecond($numberTwo): void
    {
        $this->calculatedResult = $this->calcService->multiplication($this->firstNumber, $numberTwo);
    }

    /**
     * @When /I divide the first number by a second number (-?\d+\.*\d*)/
     */
    public function iDivideFirstBySecond($numberTwo): void
    {
        try {
            $this->calculatedResult = $this->calcService->division($this->firstNumber, $numberTwo);
        } catch (DivisionByZeroError $e) {
            $this->lastException = $e;
        }

    }

    /**
     * @Then /the (?:quotient|sum|difference|product) should be (-?\d+\.*\d*)/
     */
    public function theResultShouldBe(float $estimatedResult): bool
    {
        if ($this->calculatedResult === $estimatedResult) {
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
