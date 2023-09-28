<?php

namespace Netlogix\PhpUnit\Test\Service;


use Netlogix\PhpUnit\Service\CalcService;
use PHPUnit\Framework\TestCase;

class CalcServiceTest extends TestCase
{

    function testInit()
    {
        $calc = new CalcService();
        self::assertInstanceOf(CalcService::class, $calc);
    }

    static function additionProvider(): array
    {
        return [
            'a' => [1, 2, 3],
            'b' => [-0.6, 0.8, 0.2],
            'c' => [0123, 2, 85],
            'd' => [0123, 123.35, 206.35],
            'e' => [0.1, 0.7, 0.8],
            'f' => [0.1, -0.7, -0.6],
            'g' => [3.3543876, -54687.3543878, -54684.0000002],
        ];
    }

    /**
     * @dataProvider additionProvider
     */
    function testAddition(float $a, float $b, float $expected)
    {
        $calc = new CalcService();
        self::assertEquals($expected, $calc->addition($a, $b));
    }

    static function subtractionProvider(): array
    {
        return [
            'a' => [1, 2, -1],
            'b' => [-0.6, 0.8, -1.4],
            'c' => [0123, 2, 81],
            'd' => [0123, 123.35, -40.35],
            'e' => [0.8, 0.7, 0.1],
            'f' => [0.1, -0.7, 0.8],
            'g' => [3.3543876, -54687.3543878, 54690.7087752],
            'h' => [-0.1, -0.7, 0.6],
            'i' => [-0.1, 0.7, -0.8],
            'j' => [-1, 0.7, -1.7],
            'k' => [-1 + 3, 0.6, 1.4],
            'l' => [0.7 + 0.1, 0.8, 0],
        ];
    }

    /**
     * @dataProvider subtractionProvider
     */
    function testSubtraction(float $a, float $b, float $expected)
    {
        $calc = new CalcService();
        self::assertEquals($expected, $calc->subtraction($a, $b));
    }


    static function multiplicationProvider(): array
    {
        return [
            'a' => [1, 2, 2],
            'b' => [-0.6, 0.8, -0.48],
            'c' => [0123, 2, 166],
            'd' => [123.35, 0123, 10238.05],
            'e' => [0.1, 0.7, 0.07],
            'f' => [-0.1, -0.7, 0.07],
            'g' => [0, 357687, 0],
            'i' => [274, 0, 0],
            'j' => [25 - 3, 6, 132],
        ];
    }

    /**
     * @dataProvider multiplicationProvider
     */
    function testMultiplication(float $a, float $b, float $expected)
    {
        $calc = new CalcService();
        self::assertEquals($expected, $calc->multiplication($a, $b));
    }

    static function divisionProvider(): array
    {
        return [
            'a' => [1, 2, 0.5],
            'b' => [-0.6, 0.8, -0.75],
            'c' => [0123, 2, 41.5],
            'd' => [166.83, 0123, 2.01],
            'e' => [0.1, 0.7 + 0.1 - 0.8, NULL, \DivisionByZeroError::class],
            'f' => [-0.14, -0.7, 0.2],
            'g' => [0, 357687, 0],
            'i' => [274, 0, NULL, \DivisionByZeroError::class],
            'j' => [25 - 4, 6, 3.5],
        ];
    }

    /**
     * @dataProvider divisionProvider
     */
    function testDivision(float $a, float $b, ?float $expected, ?string $exception=NULL)
    {
        if ($exception !== NULL) {
            self::expectException($exception);
        }
        $calc = new CalcService();
        $value = $calc->division($a, $b);
        if ($expected !== NULL) {
            self::assertEquals($expected, $value);
        }

    }
}
