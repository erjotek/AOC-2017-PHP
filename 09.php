<?php

function input($input)
{
    $lines = explode("\n", $input)[0];

    return $lines;
}


function part1($input)
{
    return calc($input)[0]; // 14204
}


function part2($input)
{
    return calc($input)[1]; // 6622
}


function calc($input)
{
    $gc = 0;
    $level = 0;
    $groups = [];
    $garbage = false;
    $sum = 0;

    for ($i = 0, $iMax = strlen($input); $i < $iMax; $i++) {
        if ($input[$i] === '!') {
            $i+=1;
            continue;
        }
        if ($input[$i] === '<' && !$garbage) {
            $garbage = true;
            $gc--;
        }

        if ($input[$i] === '>' && $garbage) {
            $garbage = false;
        }

        if (isset($garbage) && $garbage) {
            $gc ++;
            continue;
        }

        if ($input[$i] === '{') {
            $level++;
        }

        if ($input[$i] === '}') {
            $groups[$level] ??= 0;
            $groups[$level]++;
            $level--;
        }
    }

    foreach ($groups as $level => $count) {
        $sum += $level * $count;
    }
    return [$sum, $gc];
}

include __DIR__ . '/template.php';
