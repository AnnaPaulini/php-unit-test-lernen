<?php

namespace Netlogix\PhpUnit\Service;

class CalcService
{

    private function detLenFractPart (float $a): int
    {
        $numberFractionPartLength = 0;
        $a_string = strval($a);
        $begin_fractionpart = strpos($a, ".");
        if ($begin_fractionpart !== false) {
            $numberFractionPartLength = strlen($a_string) - $begin_fractionpart - 1;
        }
        return $numberFractionPartLength;
    }

    function addition(float $a, float $b): float
    {
        $accuracy = max ($this->detLenFractPart($a), $this->detLenFractPart($b));
        $result = $a + $b;
        return round($result, $accuracy);
    }

    function subtraction(float $a, float $b): float
    {
        $accuracy = max ($this->detLenFractPart($a), $this->detLenFractPart($b));
        $result = $a - $b;
        return round($result, $accuracy);
    }

    function multiplication(float $a, float $b): float
    {
        return $a * $b;
    }

    function division(float $a, float $b): float
    {

        return $a / $b;
    }
}
