<?php

function input($input)
{
    $lines = explode("\n", $input);
    $lines = array_column(array_map(fn($l) => explode(' with ', $l), $lines), 1);

    return $lines;
}

function part1($input)
{
    return calc($input, false); //573
}

function part2($input)
{
    return calc($input, true); //294
}

function calc($input, $part2 = false): int
{
    [$a, $b] = $input;
    $amul = 16807;
    $bmul = 48271;
    $mul = 2147483647;

    $total = 0;

    if ($part2) {
        $limit = 5_000_000;
        $al = 4;
        $bl = 8;
    } else {
        $limit = 40_000_000;
        $al = 1;
        $bl = 1;
    }

    while ($limit--) {
        do {
            $a = (($a * $amul) % $mul);
        } while ($a % $al !== 0);

        do {
            $b = (($b * $bmul) % $mul);
        } while ($b % $bl !== 0);

        if (decbin((string)($a % 65536)) === decbin((string)($b % 65536))) {
            $total++;
        }
    }
    return $total;
}

include __DIR__ . '/template.php';
