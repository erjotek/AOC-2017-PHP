<?php

include __DIR__ . '/knotHash.php';

function input($input)
{
    return $input;
}

function part1($input)
{
    return hashKnot(explode(',', $input)); //46600
}

function part2($input)
{
    return fullHashKnot($input); //23234babdc6afa036749cfa9b597de1b
}

include __DIR__ . '/template.php';
