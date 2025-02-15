<?php

function input($input)
{
    $lines = explode("\n", $input);

    $inputs = [];
    $outputs = [];

    foreach ($lines as $id => $line) {
        [$in, $out] = explode(' => ', $line);
        $out = explode('/', $out);
        $outputs[$id] = $out;

        $in = explode('/', $in);
        $inputs[implode('/', $in)] = $id;

        $in = array_reverse($in);
        $inputs[implode('/', $in)] = $id;


        $in = array_map('strrev', $in);
        $inputs[implode('/', $in)] = $id;


        $in = array_reverse($in);
        $inputs[implode('/', $in)] = $id;


        $flip = array_map('str_split', $in);
        $flip = array_map(null, ...$flip);
        $flip = array_map(fn($row) => implode('', $row), $flip);
        $in = $flip;
        $inputs[implode('/', $in)] = $id;


        $in = array_reverse($in);
        $inputs[implode('/', $in)] = $id;


        $in = array_map('strrev', $in);
        $inputs[implode('/', $in)] = $id;


        $in = array_reverse($in);
        $inputs[implode('/', $in)] = $id;
    }

    return [$inputs, $outputs];
}

function part1($input)
{
    return fractal($input, 5); // 164
}


function part2($input)
{
    return fractal($input, 18);//2355110
}

function fractal($input, $iters)
{
    [$inputs, $outputs] = $input;

    $pic = <<<PIC
.#.
..#
###
PIC;
    $pic = explode("\n", $pic);

    for ($i = 0; $i < $iters; $i++) {
        $newpic = [];

        if (strlen($pic[0]) % 2 === 0) {
            for ($r = 0; $r < count($pic) / 2; $r++) {
                for ($c = 0; $c < strlen($pic[0]) / 2; $c++) {
                    $test = substr($pic[$r * 2], $c * 2, 2) . "/"
                        . substr($pic[$r * 2 + 1], $c * 2, 2);

                    $pattern = $outputs[$inputs[$test]];

                    for ($x = 0; $x < 3; $x++) {
                        $newpic[$r * 3 + $x] ??= '';
                        $newpic[$r * 3 + $x] .= $pattern[$x];
                    }
                }
            }
        } else {
            for ($r = 0; $r < count($pic) / 3; $r++) {
                for ($c = 0; $c < strlen($pic[0]) / 3; $c++) {
                    $test = substr($pic[$r * 3], $c * 3, 3) . "/"
                        . substr($pic[$r * 3 + 1], $c * 3, 3) . "/"
                        . substr($pic[$r * 3 + 2], $c * 3, 3);

                    $pattern = $outputs[$inputs[$test]];

                    for ($x = 0; $x < 4; $x++) {
                        $newpic[$r * 4 + $x] ??= '';
                        $newpic[$r * 4 + $x] .= $pattern[$x];
                    }
                }
            }
        }

        $pic = $newpic;
    }

    $sum = 0;
    foreach ($pic as $row) {
        $cc = count_chars($row, 1);
        $sum += $cc[35] ?? 0;
    }

    return $sum; //164
}


include __DIR__ . '/template.php';
