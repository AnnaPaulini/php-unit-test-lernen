<?php

namespace Netlogix\PhpUnit\Service;

class CalcService
{

    private function detLenFractPart (float $a): int
    {
//        $numberFractionPartLength = 0;
        $a_string = strval($a);
        $parts = explode(".", $a_string);
         return strlen($parts[1]??"");
//        $begin_fractionpart = strpos($a, ".");
//        if ($begin_fractionpart !== false) {
//            $numberFractionPartLength = strlen($a_string) - $begin_fractionpart - 1;
//        }
//        return $numberFractionPartLength;
    }

    private function detFuzzinessStart (float $a): int
    {
        $fuzzy_start = -1;
        $a_string = strval($a);


//        $a_string = strval(0.7499999999999999);
//        echo $a_string . "\n";
//        echo "0.7499999999999999" . "\n";
//        echo 0.7499999999999999 . "\n";
//        echo $a . "\n";


        $parts = explode(".", $a_string);

//        print_r($parts);
//        $parts = explode(".", "0.7499999999999999");
//        print_r($parts);
//        $parts = explode(".", "0.20000000000000004");
//        print_r($parts2);
//        $parts = explode(".", "2.0100000000000002");
//        print_r($parts);
//        $parts = explode(".", "2.0100000300000002");
//        print_r($parts4);


        if ($parts[1] === null) {
            echo $fuzzy_start . "\n";
            return $fuzzy_start;
//        } elseif ((str_contains($parts[1], "0") === false) && !(str_contains($parts[1], "9")=== false)) {
////            $fuzzy_start = -2;
////            echo strpos($parts[1], "0") . "\n";
////            echo $fuzzy_start . "\n";
//            return $fuzzy_start;
        } else {
            $pattern_9 = "/(^[0-8]+)(9{3,}$)/";
            $pattern_0x = "/(^[0-9]*[1-9])(0{3,}[1-9]$)/";

            $found_pattern = preg_match($pattern_9, $parts[1], $matches, PREG_OFFSET_CAPTURE);
            if ($found_pattern === 0) {
                $found_pattern = preg_match($pattern_0x, $parts[1], $matches, PREG_OFFSET_CAPTURE);
//                print_r($matches);
                if ($found_pattern === 0) {
                    return $fuzzy_start;
                }
            }
//            print_r($matches);
            $fuzzy_start = $matches[2][1];
            echo $fuzzy_start . "\n";

//            preg_match($pattern_9, $parts0[1], $matches);
//            print_r($matches);
//            preg_match($pattern_0x, $parts2[1], $matches);
//            print_r($matches);
//            preg_match($pattern_0x, $parts3[1], $matches);
//            print_r($matches);
//            preg_match($pattern_0x, $parts4[1], $matches);
//            print_r($matches);


            return $fuzzy_start;
        }
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
        $accuracy = $this->detLenFractPart($a) + $this->detLenFractPart($b);
        $result = $a * $b;
        return round($result, $accuracy);
    }

    function division(float $a, float $b): float
    {
        $result = $a / $b;
//        $is_fuzzy = $this->detFuzzinessStart($a / $b);
//        echo $is_fuzzy . "\n";
//        if ($is_fuzzy === -1) {
//            return $result;
//        } else {
//            return round($result, $is_fuzzy - 1);
//        }
//        //        echo $result . "\n";
////        $this->detFuzzinessStart(0.7499999999999999);

        return $result;
    }
}
