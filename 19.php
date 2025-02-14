<?php

function input($input)
{
    $lines = explode("\n", $input);
    $lines = array_map(fn($l) => str_split($l), $lines);

    return $lines;
}

function part1($input)
{
    return go($input); //VTWBPYAQFU
}

function part2($input)
{
    return go($input, true); //17358
}

function go($input, $part2 = false)
{
    foreach ($input[0] as $col => $char) {
        if ($char === '|') {
            break;
        }
    }

    $pos = [0, $col];

    $dir = [1, 0];

    $steps = 0;

    $letters = '';

    while (true) {
        $char = $input[$pos[0]][$pos[1]];

        if (ord($char) >= 65 && ord($char) <= 90) {
            $letters .= $char;
        }

        if ($char === '+') {
            if ($dir[1] === 0) {
                if (($input[$pos[0]][$pos[1] + 1] ?? ' ') !== ' ') {
                    $dir = [0, 1];
                } else {
                    $dir = [0, -1];
                }
            } else {
                if (($input[$pos[0] + 1][$pos[1]] ?? ' ') !== ' ') {
                    $dir = [1, 0];
                } else {
                    $dir = [-1, 0];
                }
            }
        }

        if ($char === ' ') {
            break;
        }

        $pos = [$pos[0] + $dir[0], $pos[1] + $dir[1]];
        $steps++;
    }

    return $part2 ? $steps : $letters;
}

include __DIR__ . '/template.php';
