<?php

function input($input)
{
    $lines = explode("\n", $input);
    $state = '';
    $ins = [];
    foreach ($lines as $line) {
        if (preg_match('~ after (\d+) step~', $line, $ret)) {
            $steps = $ret[1];
        }

        if (preg_match('~In state (\w):~', $line, $ret)) {
            $state = $ret[1];
        }

        if (preg_match('~If the current value is (\d):~', $line, $ret)) {
            $forval = $ret[1];
        }

        if (preg_match('~Write the value (\d)~', $line, $ret)) {
            $ins[$state][$forval]['val'] = $ret[1];
        }

        if (preg_match('~Move one slot to the (\w+).~', $line, $ret)) {
            $ins[$state][$forval]['pos'] = $ret[1] == 'left' ? -1 : 1;
        }

        if (preg_match('~Continue with state (\w).~', $line, $ret)) {
            $ins[$state][$forval]['next'] = $ret[1];
        }
    }

    return [$steps, $ins];
}

function part1($input)
{
    [$steps, $ins] = $input;

    $tape = [];
    $pos = 0;
    $state = 'A';

    for ($step = 0; $step < $steps; $step++) {
        $tape[$pos] ??= 0;
        $do = $ins[$state][$tape[$pos]];
        $tape[$pos] = $do['val'];
        $pos += $do['pos'];
        $state = $do['next'];
    }

    return array_sum($tape); //5744
}

function part2($input)
{
    return;
}

include __DIR__ . '/template.php';
