<?php

function input($input)
{
    $input = explode("\n", $input);

    return $input;
}

function part1($input)
{
    return
        array_sum(
            array_map(fn($l) => max($l) - min($l),
                array_map(fn($l) => explode("\t", $l),
                    $input
                )
            )
        ); //36766
}

function part2($input)
{
    $input = array_map(fn($l) => explode("\t", $l), $input);

    $sum = 0;
    $c = count($input[0]);
    foreach ($input as $line) {
        for ($i = 0; $i < $c - 1; $i++) {
            for ($j = $i + 1; $j < $c; $j++) {
                $d = max($line[$i], $line[$j]) / min($line[$i], $line[$j]);
                if (is_int($d)) {
                    $sum += $d;
                    break 2;
                }
            }
        }
    }

    return $sum; //261
}

include __DIR__ . '/template.php';
