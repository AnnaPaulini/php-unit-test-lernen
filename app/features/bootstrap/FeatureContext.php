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
    private float $secondNumber;

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
     * @Given /I have two numbers: (-?\d+\.*\d*) and (-?\d+\.*\d*)/
     */
    public function iHaveTwoNumbers(float $numberOne, float $numberTwo): void
    {
        $this->firstNumber = $numberOne;
        $this->secondNumber = $numberTwo;
    }

    /**
     * @When I add the second number to the first number
     */
    public function iAddSecondToFirst(): void
    {
        $this->calculatedResult = $this->calcService->addition($this->firstNumber, $this->secondNumber);
    }

    /**
     * @When I subtract the second number from the first number
     */
    public function iSubtractSecondFromFirst(): void
    {
        $this->calculatedResult = $this->calcService->subtraction($this->firstNumber, $this->secondNumber);
    }

    /**
     * @When I multiply the first number by the second number
     */
    public function iMultiplyFirstBySecond(): void
    {
        $this->calculatedResult = $this->calcService->multiplication($this->firstNumber, $this->secondNumber);
    }

    /**
     * @When I divide the first number by the second number
     */
    public function iDivideFirstBySecond(): void
    {
        try {
            $this->calculatedResult = $this->calcService->division($this->firstNumber, $this->secondNumber);
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
