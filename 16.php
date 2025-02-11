<?php

function input($input)
{
    $lines = explode(",", $input);

    return $lines;
}

function part1($input)
{
    $progs = implode('', range('a', 'p'));

    $progs = dance($input, $progs);

    return $progs; //lgpkniodmjacfbeh
}


function part2($input)
{
    $progs = implode('', range('a', 'p'));

    $memo = [];
    $memo2 = [];
    for ($i = 1; $i < 100; $i++) {
        if (isset($memo[$progs])) {
            break;
        }
        $memo[$progs] = $i;
        $memo2[$i] = $progs;

        $progs = dance($input, $progs);
    }

    return $memo2[(1000000001) % ($i - 1)]; //hklecbpnjigoafmd
}

function dance($input, string $progs): mixed
{
    foreach ($input as $line) {
        if ($line[0] === 's') {
            $val = substr($line, 1);
            $progs = substr($progs, -$val) . substr($progs, 0, -$val);
        }

        if ($line[0] === 'x') {
            [$from, $to] = explode('/', substr($line, 1));
            $tmp = $progs[$from];
            $progs[$from] = $progs[$to];
            $progs[$to] = $tmp;
        }
        if ($line[0] === 'p') {
            [$from, $to] = explode('/', substr($line, 1));
            $progs = str_replace([$from, $to, '#'], ['#', $from, $to], $progs);
        }
    }
    return $progs;
}


include __DIR__ . '/template.php';
