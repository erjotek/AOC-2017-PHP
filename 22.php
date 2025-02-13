<?php

function input($input)
{
    $lines = explode("\n", $input);
    $lines = array_map(fn($l) => str_split($l), $lines);

    return $lines;
}

function part1($input)
{
    return infection($input); //5196
}

function part2($input)
{
    return infection($input, true); //2511633
}

function infection($input, $part2 = false): int
{
    $pos = [floor(count($input) / 2), floor(count($input[0]) / 2)];

    $dirs = [[-1, 0], [0, 1], [1, 0], [0, -1]];
    $dir = 0;

    $burns = 0;

    $count = $part2 ? 10000000 : 10000;

    for ($i = 0; $i < $count; $i++) {
        $input[$pos[0]][$pos[1]] ??= '.';

        switch ($input[$pos[0]][$pos[1]]) {
            case '#':
                $dir = ($dir + 1) % 4;
                $input[$pos[0]][$pos[1]] = $part2 ? 'F': '.';
                break;

            case '.':
                $dir = (($dir + 4) - 1) % 4;
                $input[$pos[0]][$pos[1]] = $part2 ? 'W' : '#';

                if (!$part2) {
                    $burns++;
                }
                break;

            case 'W':
                $input[$pos[0]][$pos[1]] = '#';
                $burns++;
                break;

            case 'F':
                $dir = ($dir + 2) % 4;
                $input[$pos[0]][$pos[1]] = '.';
                break;
        }


        $pos = [$pos[0] + $dirs[$dir][0], $pos[1] + $dirs[$dir][1]];
    }

    return $burns;
}


include __DIR__ . '/template.php';
