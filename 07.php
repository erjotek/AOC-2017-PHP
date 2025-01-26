<?php

$discs = [];
$root = null;

function input($input)
{
    $input = explode("\n", $input);
    return $input;
}

function part1($input)
{
    global $discs;

    foreach ($input as $i) {
        preg_match('~(\w+) \((\d+)\)(?> -> (.*))?~', $i, $ret);
        $discs[$ret[1]]['weight'] = $ret[2];
        if (!empty($ret[3])) {
            $children = explode(', ', $ret[3]);
            $discs[$ret[1]]['children'] = $children;

            foreach ($children as $child) {
                $discs[$child]['parent'] = $ret[1];
            }
        }
    }

    global $root;
    $root = key(array_filter($discs, fn($d) => empty($d['parent'])));

    return $root; //gmcrj
}


function part2($input)
{

    global $discs;
    global $root;

    $all = discssum($root);

    $prev_ok = 0;
    $prev_wrong = 0;
    $prev_name = null;
    while (true) {
        $test = [];
        foreach ($all[1] as $an => $aa) {
            $test[$aa[0]][] = $an;
        }

        if (count($test) == 1) {
            return $discs[$prev_name]['weight'] - ($prev_wrong - $prev_ok); // //391 mdbtyw
        }

        foreach ($test as $val => $names) {
            if (count($names) == 1) {
                $prev_name = $names[0];
                $prev_wrong = $val;
                $all = $all[1][$names[0]];
            } else {
                $prev_ok = $val;
            }
        }
    }
}

function discssum($root)
{
    global $discs;
    $sum = $discs[$root]['weight'];

    if (!isset($discs[$root]['children'])) {
        return [$sum, null];
    }

    $ret = [];
    foreach ($discs[$root]['children'] as $d) {
        $c = discssum($d);
        $sum += $c[0];

        $ret[$d] = $c;
    }

    return [$sum, $ret];
}

include __DIR__ . '/template.php';
