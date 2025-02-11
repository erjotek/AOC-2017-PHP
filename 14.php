<?php

include __DIR__ . '/knotHash.php';
$area = [];

function input($input)
{
    return $input;
}

function part1($input)
{
    global $area;

    $sum = 0;

    for ($i = 0; $i < 128; $i++) {
        $hash = fullHashKnot("$input-$i");
        $fullline = '';
        foreach (str_split($hash) as $l) {
            $line = sprintf('%04d', decbin(hexdec($l)));
            $fullline .= $line;
        }
        $sum += array_sum(str_split($fullline));
        $area[] = str_split($fullline);
    }

    return $sum; //8140
}

function part2($input)
{
    global $area;
    $dirs = [[0, 1], [0, -1], [1, 0], [-1, 0]];

    $regions = 0;
    $visited = [];
    for ($row = 0; $row < 128; $row++) {
        for ($col = 0; $col < 128; $col++) {
            if (isset($visited[$row][$col]) || !$area[$row][$col]) {
                continue;
            }

            $regions++;

            $q = new SplQueue();
            $q->enqueue([$row, $col]);

            while (!$q->isEmpty()) {
                $pos = $q->dequeue();
                if (isset($visited[$pos[0]][$pos[1]])) {
                    continue;
                }

                $visited[$pos[0]][$pos[1]] = true;

                foreach ($dirs as $dir) {
                    $npos = [$pos[0] + $dir[0], $pos[1] + $dir[1]];

                    if (isset($area[$npos[0]][$npos[1]])
                        && !isset($visited[$npos[0]][$npos[1]])
                        && $area[$npos[0]][$npos[1]] == 1
                    ) {
                        $q->enqueue($npos);
                    }
                }
            }
        }
    }

    return $regions; //1182
}

include __DIR__ . '/template.php';
