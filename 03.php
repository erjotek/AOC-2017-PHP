<?php

function input($input)
{
    return $input;
}

function part1($input)
{
    $pos = mem_fast($input);
    return abs($pos[0]) + abs($pos[1]); //371
}

function part2($input)
{
    return mem_sum($input, true); //369601
}


function mem_fast($id)
{
    if ($id === 1) {
        return [0, 0];
    }

    $hi = ceil(sqrt($id));
    $hi_square = $hi ** 2;

    $low = floor(sqrt($id));
    $low_square = $low ** 2;

    $edge = ($hi_square + $low_square + 1) / 2;

    if ($hi % 2) { // bottom left
        if ($hi === $low) {
            $pos = ($low - 1) / 2;

            return [$pos, $pos];
        }

        $half_low = ($low / 2);
        if ($id < $edge) { // left
            $x = -$half_low;
            $y = $id - ($edge + $low_square + 1) / 2;
        } else { // bottom
            $x = $id - ($edge + $hi_square) / 2;
            $y = $half_low;
        }
    } else { // top right
        if ($hi === $low) {
            $pos = -($low / 2);

            return [$pos + 1, $pos];
        }

        $half_hi = $hi / 2;
        if ($id < $edge) { // right
            $x = $half_hi;
            $y = ($edge + $low_square) / 2 - $id;
        } else { // top
            $x = ($edge + $hi_square + 1) / 2 - $id;
            $y = -$half_hi;
        }
    }

    return [$x, $y];
}

function mem_sum($input, $val = false)
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

    return [$x, $y];
}

include __DIR__ . '/template.php';
