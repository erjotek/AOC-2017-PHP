<?php

function mem($input, $val = false)
{
    $dirs = [[0, 1], [-1, 0], [0, -1], [1, 0]];
    $dir = 0;
    $my = 0;
    $mx = 1;
    $x = 0;
    $y = 0;

    $mem[0][0] = 1;

    for ($i = 1; $i < $input; $i++) {
        $y += $dirs[$dir][0];
        $x += $dirs[$dir][1];

        $mem[$y][$x] = array_sum(
            [
                $mem[$y - 1][$x - 1] ?? 0,
                $mem[$y - 1][$x] ?? 0,
                $mem[$y - 1][$x + 1] ?? 0,
                $mem[$y][$x - 1] ?? 0,
                // $mem[$y][$x],
                $mem[$y][$x + 1] ?? 0,
                $mem[$y + 1][$x - 1] ?? 0,
                $mem[$y + 1][$x] ?? 0,
                $mem[$y + 1][$x + 1] ?? 0,
            ]
        );

        if ($val && $mem[$y][$x] > $input) {
            return $mem[$y][$x];
        }

        if ($x === $mx && !$dirs[$dir][0]) {
            $my++;
            $dir = ++$dir % 4;
            continue;
        }

        if ($x === -$mx && !$dirs[$dir][0]) {
            $dir = ++$dir % 4;
            continue;
        }

        if ($y === $my && !$dirs[$dir][1]) {
            $mx++;
            $dir = ++$dir % 4;
            continue;
        }

        if ($y === -$my && !$dirs[$dir][1]) {
            $dir = ++$dir % 4;
            continue;
        }
    }

    return abs($x) + abs($y); //371
}

function part1($input)
{
    return mem($input, false);
}

function part2($input)
{
    return mem($input, true);
}

include __DIR__ . '/../template.php';
