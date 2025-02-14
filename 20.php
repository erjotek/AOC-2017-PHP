<?php

function input($input)
{
    $lines = explode("\n", $input);
    $lines = array_map(function ($l) {
        preg_match(
            '~p=<([- ]?\d+),([ -]?\d+),([ -]?\d+)>, v=<([ -]?\d+),([ -]?\d+),([ -]?\d+)>, a=<([ -]?\d+),([ -]?\d+),([ -]?\d+)>~',
            $l,
            $ret
        );
        return $ret;
    }, $lines);

    return $lines;
}

function part1($input)
{
    return gpu($input); //144
}

function part2($input)
{
    return gpu($input, true); //477
}

function gpu($input, $part2 = false): int
{
    for ($i = 0; $i < 500; $i++) {
        $coll = [];
        $ni = $input;

        foreach ($ni as $id => &$info) {
            [, $px, $py, $pz, $vx, $vy, $vz, $ax, $ay, $az] = $info;

            foreach (['x', 'y', 'z'] as $l) {
                ${"v$l"} += ${"a$l"};
                ${"p$l"} += ${"v$l"};
            }

            $coll["$px-$py-$pz"][] = $id;

            $mh = abs($px) + abs($py) + abs($pz);
            $info = [$mh, $px, $py, $pz, $vx, $vy, $vz, $ax, $ay, $az];
        }

        unset($info);

        if ($part2) {
            foreach ($coll as $pkey => $points) {
                if (count($points) > 1) {
                    foreach ($points as $pid) {
                        unset($ni[$pid]);
                    }
                }
            }
        }

        $input = $ni;
    }

    if ($part2) {
        return count($input);
    }

    $min = PHP_INT_MAX;
    $best = 0;
    foreach ($input as $id => $val) {
        if ($min > $val[0]) {
            $min = $val[0];
            $best = $id;
        }
    }

    return $best;
}

include __DIR__ . '/template.php';
