<?php

function input($input)
{
    $lines = explode("\n", $input);
    $lines = array_map(fn($l) => explode(' ', $l), $lines);

    return $lines;
}

function part1($input)
{
    $regs = array_fill_keys(array_column($input, 1), 0);

    $queue = [];

    $pos = 0;

    while (true) {
        $count = count($queue);
        $ret = prog($input, $pos, $regs, $queue);
        if ($count > count($queue)) {
            return array_pop($queue);
        }
        if ($ret !== false && $ret !== null) {
            $queue[] = $ret;
        }
    }

    return $play; //2951
}


function part2($input)
{
    $sends = 0;

    $regs_a = array_fill_keys(array_column($input, 1), 0);
    $regs_b = array_fill_keys(array_column($input, 1), 0);
    $pos_a = 0;
    $pos_b = 0;

    $regs_a['p'] = 0;
    $regs_b['p'] = 1;

    $queue_a = [];
    $queue_b = [];

    while (true) {
        $ret_a = prog($input, $pos_a, $regs_a, $queue_a);

        if ($ret_a !== false && $ret_a !== null) {
            $queue_b[] = $ret_a;
        }

        $ret_b = prog($input, $pos_b, $regs_b, $queue_b);
        if ($ret_b !== false && $ret_b !== null) {
            $queue_a[] = $ret_b;
            $sends++;
        }

        if ($ret_a === false && $ret_b === false) {
            break;
        }
    }

    return $sends; //7366
}

function prog($input, int &$pos, array &$regs, array &$queue)
{
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
        case 'mul':
            $regs[$ins[1]] *= $opt;
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
    }

    $pos++;
    return null;
}

include __DIR__ . '/template.php';
