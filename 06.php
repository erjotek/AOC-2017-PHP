<?php

$part2 = 0;

function input($input)
{
    $input = explode("\t", $input);

    return $input;
}

function part1($input)
{
    $c = count($input);
    $seen = [];
    $i = 0;
    while (!isset($seen[implode('-', $input)])) {
        $seen[implode('-', $input)] = $i++;
        $key = (int)array_search(max($input), $input);
        $val = $input[$key];
        $input[$key] = 0;
        while ($val) {
            $input[++$key % $c]++;
            $val--;
        }
    }

    global $part2;
    $part2 = $i - $seen[implode('-', $input)];

    return $i; //12841
}

function part2($input)
{
    global $part2;
    return $part2; //8038
}

include __DIR__ . '/template.php';
