<?php


function input($input)
{
    $input = explode("\n", $input);

    return $input;
}


function part1($input)
{
    return count(
        array_filter(
            $input,
            fn($l) => explode(" ", $l) === array_unique(explode(" ", $l))
        )
    ); // 325
}

function part2($input)
{
    return count(
        array_filter(
            $input,
            function ($l) {
                $l = explode(" ", $l);
                $m = array_unique(
                    array_map(function ($x) {
                        $x = str_split($x);
                        sort($x);

                        return implode($x);
                    }, $l)
                );

                return count($m) === count($l);
            }
        )
    ); //119
}

include __DIR__ . '/template.php';
