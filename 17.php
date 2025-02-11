<?php

function input($input)
{
    $inp2ut = <<<TEST
3
TEST;

    return $input;
}

function part1($input)
{
    $list = new SplDoublyLinkedList();
    $list->push(0);

    $pos = 0;
    for ($i = 1; $i <= 2017; $i++) {
        $pos = ($pos + $input) % $i + 1;
        $list->add($pos, $i);
    }

    return $list[$pos + 1]; //1506
}

function part2($input)
{
    $pos = 0;
    $val = 0;
    for ($i = 1; $i <= 50000000; $i++) {
        $pos = ($pos + $input) % $i + 1;
        if ($pos === 1) {
            $val = $i;
        }
    }

    return $val; //39479736
}

include __DIR__ . '/template.php';
