<?php

$max = 0;
$len = 0;
$max_len = [];
function input($input)
{
    $lines = explode("\n", $input);
    $lines = array_map(fn($l) => explode('/', $l), $lines);

    return $lines;
}

function part1($input)
{
    connection($input, 0);

    global $max;
    return $max; //1906
}

function part2($input)
{
    global $max_len;
    return array_pop($max_len); //1824
}

function connection(array $conns, int $level = 0, array $used = [])
{
    global $max;
    global $len;
    global $max_len;

    foreach ($conns as $k => $val) {
        if ($val[0] == $level) {
            $newconns = $conns;
            $newused = $used;
            $newused[] = $val;
            unset($newconns[$k]);
            connection($newconns, $val[1], $newused);
        }

        if ($val[1] == $level) {
            $newconns = $conns;
            $newused = $used;
            $newused[] = $val;
            unset($newconns[$k]);
            connection($newconns, $val[0], $newused);
        }
    }

    $newmax = 0;
    foreach ($used as $x) {
        $newmax += $x[0] + $x[1];
    }

    $max = max($max, $newmax);

    if (count($used) >= $len) {
        $len = count($used);
        $max_len[$len] = max($max_len[$len] ?? 0, $newmax);
    }
}

include __DIR__ . '/template.php';
