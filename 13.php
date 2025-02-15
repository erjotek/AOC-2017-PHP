<?php

function input($input)
{
    $lines = explode("\n", $input);
    $lines = array_map(fn($l) => explode(': ', $l), $lines);
    $lines = array_column($lines, 1, 0);
    return $lines;
}

function part1($input)
{
    return firewall($input, 0); //2264
}


function part2($input)
{
    for ($time = 0; $time < 10000000; $time++) {
        if (!firewall($input, $time)) {
            return $time;
        }
    }

    return; // 3875838
}

function firewall($input, $time): int
{
    $ile = 0;
    foreach ($input as $layer => $depth) {
        if (($layer + $time) % ($depth * 2 - 2) === 0) {
            if ($time) {
                return 1;
            }
            $ile += $layer * $depth;
        }
    }

    return $ile;
}

include __DIR__ . '/template.php';
