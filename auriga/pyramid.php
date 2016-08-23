<?php
/**
 * 1. Написать функцию, которая выводит числа от 1 до N в виде лесенки.
 * pyramid(12);
 *
 *  1
 *  2,   3
 *  4,   5,  6
 *  7,   8,  9,  10
 *  11, 12
 */

function pyramid($limit) {
    $stack = [];
    $line = 1;

    $format = '%'.(strlen($limit) + 2).'d';

    $num = 0;
    while($num < $limit) {
        $num++;

        $stack[] = $num;
        if(sizeof($stack) == $line || $num == $limit) {
            yield call_user_func_array('sprintf',
                    array_merge(
                        [str_repeat($format.", ", sizeof($stack) - 1).$format],
                        $stack)
                )."\n";
            $stack = [];
            $line++;
        }
    }
}

if(!isset($argv[1])) {
    die("Usage: php pyramid.php <LIMIT>\n");
}

foreach(pyramid($argv[1]) AS $line) {
    print($line);
}