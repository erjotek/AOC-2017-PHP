<?php

function input($input)
{
    $lines = explode("\n", $input)[0];
    return $lines;
}

function part1($input)
{
    return hashKnot(explode(',', $input)); //46600
}

function part2($input)
{
    $input = str_split($input);
    $input = array_map('ord', $input);
    $input = implode(',', $input);

    $input .= ',17,31,73,47,23';
    $input = explode(',', $input);
    return hashKnot($input, 64);
}

function hashKnot($input, $rounds = 1)
{
    $size = 256;
    $table = [];
    $pos = 0;
    $skip = 0;
    for ($i = 0; $i < $size; $i++) {
        $table[$i] = $i;
    }

    for ($round = 1; $round <= $rounds; $round++) {
        foreach ($input as $ins) {
            for ($r = 0; $r < floor($ins / 2); $r++) {
                $tmp = $table[($pos + $r) % $size];
                $table[($pos + $r) % $size] = $table[($pos + $ins - 1 - $r) % $size];
                $table[($pos + $ins - 1 - $r) % $size] = $tmp;
            }

            $pos = ($pos + ($ins + $skip)) % $size;
            $skip++;
        }
    }

    if ($rounds === 1) {
        return $table[0] * $table[1];
    }

    $wyn = [];

    for ($g = 0; $g<16;$g++) {
        $tmp = 0;
        for ($p = 0; $p<16; $p++) {
            $tmp ^= $table[$g*16+$p];
        }
        $wyn[$g] = $tmp;
    }

    return implode('', array_map(fn($c) => sprintf('%02s', dechex($c)), $wyn));
}

include __DIR__ . '/template.php';
