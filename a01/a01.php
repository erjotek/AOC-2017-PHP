<?php

function part1($input)
{
    preg_match_all('/(\d)\1+/', $input . $input[0], $ret);
    return array_sum(array_map(fn($l) => (strlen($l) - 1) * $l[0], $ret[0])); //1253
}

function part2($input)
{
    /*
    $sum = 0;
    $l = strlen($input);
    $l2 = (int)(strlen($input) / 2);
    $input .= $input;
    for ($i = 0; $i < $l; $i++) {
        if ($input[$i] === $input[$i + $l2]) {
            $sum += $input[$i];
        }
    }

    return $sum;
    */

    $l2 = (int)(strlen($input) / 2 - 1);
    preg_match_all('/(\d)(?=.{'.$l2.'}\1)/', $input . substr($input, 0, $l2), $ret);

    return array_sum($ret[0]); //1278
}

include __DIR__ . '/../template.php';
