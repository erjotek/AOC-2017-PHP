<?php

function part1($input, $second = false)
{
    $input = explode("\t", $input);
    $c = count($input);
    $seen = [];
    $i = 0;
    while (!isset($seen[implode('-', $input)])) {
        $i++;
        $seen[implode('-', $input)] = true;
        $key = (int)array_search(max($input), $input);
        $val = $input[$key];
        $input[$key] = 0;
        while ($val) {
            $input[++$key%$c]++;
            $val--;
        }
    }

    if ($second) {
        return part1(implode("\t", $input));
    }

    return $i; //12841
}

function part2($input)
{
    return part1($input, true); //8038
}

include __DIR__ . '/../template.php';
