<?php

function input($input)
{
    $in3put = <<<TEST
b inc 5 if a > 1
a inc 1 if b < 5
c dec -10 if a >= 1
c inc -20 if c == 10
TEST;

    $lines = explode("\n", $input);
    $lines = array_map(fn($l) => explode(' ', $l), $lines);
    return $lines;
}

function part1($input)
{
    return program($input);//5215
}


function part2($input)
{
    return program($input, true); //6419
}

function program($input, $part2 = false)
{
    $regs = [];
    $max = 0;
    foreach ($input as $line) {
        $ret = match ($line[5]) {
            '==' => ($regs[$line[4]] ?? 0) == $line[6],
            '>' => ($regs[$line[4]] ?? 0) > $line[6],
            '<' => ($regs[$line[4]] ?? 0) < $line[6],
            '>=' => ($regs[$line[4]] ?? 0) >= $line[6],
            '<=' => ($regs[$line[4]] ?? 0) <= $line[6],
            '!=' => ($regs[$line[4]] ?? 0) != $line[6],
        };

        if ($ret && $line[1] == 'inc') {
            $regs[$line[0]] ??= 0;
            $regs[$line[0]] += $line[2];
            $max = max($max, $regs[$line[0]]);
        }

        if ($ret && $line[1] == 'dec') {
            $regs[$line[0]] ??= 0;
            $regs[$line[0]] -= $line[2];
            $max = max($max, $regs[$line[0]]);
        }
    }

    return $part2 ? $max : max($regs);
}

include __DIR__ . '/template.php';
