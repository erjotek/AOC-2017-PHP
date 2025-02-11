<?php

function input($input)
{
    $lines = explode("\n", $input);
    $conns = [];
    foreach ($lines as $line) {
        [$id, $progs] = explode(' <-> ', $line);
        $progs = explode(', ', $progs);
        foreach ($progs as $prog) {
            $conns[$prog][$id] = $id;
        }
    }

    krsort($conns);
    return $conns;
}

function part1($input)
{
    return findGroup($input); //130
}


function part2($input)
{
    return findGroup($input, true); //189

}

function findGroup($input, $part2 = false)
{
    $visited = [];

    $ids = array_keys($input);

    $groups = 0;
    while (!empty($ids)) {
        $id = key($ids);
        $q = new SplQueue();
        $q->enqueue($id);

        while (!$q->isEmpty()) {
            $test = $q->dequeue();
            $visited[$test] = true;
            foreach ($input[$test] as $next) {
                if (isset($visited[$next])) {
                    continue;
                }
                $q->enqueue($next);
            }
        }

        if (!$part2) {
            return count($visited);
        }

        $ids = array_diff_key($ids, $visited);

        $groups++;
    }
    return $groups;
}

include __DIR__ . '/template.php';
