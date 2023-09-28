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
            'b' => [6, 2, 4],
            'c' => [5, 2, 7],
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
}
