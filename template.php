<?php

function display(int $part)
{
    global $argv;
    $day = basename($argv[0], '.php');

    $startMem = memory_get_peak_usage();
    $startTs = microtime(true);
    $func = 'part' . $part;
    echo "== Day $day part $part ==" . PHP_EOL;
    echo 'Result: ' . $func(input()) . PHP_EOL;
    echo 'Time  : ' . sprintf('%.5f', microtime(true) - $startTs) . ' s' . PHP_EOL;
    echo 'Memory: ' . sprintf('%.5f', ((memory_get_peak_usage() - $startMem) / 1024 /1024)) . ' MB' . PHP_EOL;
    echo PHP_EOL;
}

function input(string $name = 'input')
{
    return rtrim(file_get_contents("$name.txt"));
}

display(1); /** @uses part1() */
display(2); /** @uses part2() */
