<?php

function input($input)
{
    $input = explode("\n", $input);

    return $input;
}


function part1($input)
{
    $pos = 0;
    $i = 0;
    while (true) {
        $i++;
        $newpos = $pos + $input[$pos];
        if (!array_key_exists($newpos, $input)) {
            break;
        }
        $input[$pos]++;
        $pos = $newpos;
    }

    return $i; //358131
}

function part2($input)
{
    $pos = 0;
    $i = 0;
    while (true) {
        $i++;
        $newpos = $pos + $input[$pos];
        if (!array_key_exists($newpos, $input)) {
            break;
        }

        $input[$pos] += $input[$pos] >= 3 ? -1 : 1;
        $pos = $newpos;
    }

    return $i; //25558839
}

include __DIR__ . '/template.php';
