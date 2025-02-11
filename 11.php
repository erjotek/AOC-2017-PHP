<?php

$max = 0;

function input($input)
{
    $lines = explode(",", $input);

    return $lines;
}

function part1($input)
{
    global $max;
    $pos = [0, 0];
    $dirs = [
        'n' => [-1, 0],
        's' => [1, 0],
        'nw' => [-0.5, -0.5],
        'sw' => [0.5, -0.5],
        'ne' => [-0.5, 0.5],
        'se' => [0.5, 0.5],
    ];

    foreach ($input as $dir) {
        $pos = [$pos[0] + $dirs[$dir][0], $pos[1] + $dirs[$dir][1]];
        $max = max($max, abs($pos[0]) + abs($pos[1]));
    }

    return abs($pos[0]) + abs($pos[1]); //698
}

function part2($input)
{
    global $max;

    return $max; //1435

}

include __DIR__ . '/template.php';
