<?php

$mul = 0;
function input($input)
{
    $lines = explode("\n", $input);
    $lines = array_map(fn($l) => explode(' ', $l), $lines);

    return $lines;
}

function part1($input)
{
    $pos = 0;
    $queue = [];
    $regs = array_fill_keys(range('a', 'h'), 0);
    $max = count($input);

    while ($pos < $max) {
        prog($input, $pos, $regs, $queue);
    }

    global $mul;
    return $mul; //8281
}

function part2($input)
{
    $h = 0;
    for ($b = 109300; $b <= 126300; $b += 17) {
        for ($g = 2; $g <= ceil(sqrt($b)); $g++) {
            if ($b % $g === 0) {
                $h++;
                continue 2;
            }
        }
    }

    return $h; // 911
}

function prog($input, int &$pos, array &$regs, array &$queue)
{
    global $mul;

    $opt = null;
    $ins = $input[$pos];

    if (isset($ins[2])) {
        $opt = is_numeric($ins[2]) ? (int)$ins[2] : $regs[$ins[2]];
    }

    if ($ins[0] === 'rcv' && empty($queue)) {
        return false;
    }

    $args = is_numeric($ins[1]) ? (int)$ins[1] : $regs[$ins[1]];

    switch ($ins[0]) {
        case 'snd':
            $pos++;
            return $args;
        case 'set':
            $regs[$ins[1]] = $opt;
            break;
        case 'add':
            $regs[$ins[1]] += $opt;
            break;
        case 'sub':
            $regs[$ins[1]] -= $opt;
            break;
        case 'mul':
            $regs[$ins[1]] *= $opt;
            $mul++;
            break;
        case 'mod':
            $regs[$ins[1]] %= $opt;
            break;
        case 'rcv':
            $regs[$ins[1]] = array_shift($queue);
            break;
        case 'jgz':
            if (($args) > 0) {
                $pos += $opt;
                return null;
            }
        case 'jnz':
            if (($args) != 0) {
                $pos += $opt;
                return null;
            }
    }

    $pos++;
    return null;
}


include __DIR__ . '/template.php';
