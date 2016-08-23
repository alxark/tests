<?php
/**
 * Вывести числа от 1 до N в С столбцов, заполненных как можно более равномерно.
 * columns(10, 3)
 *
 *  1  5  8
 *  2  6  9
 *  3  7 10
 *  4
 *
 */

function columns($limit, $cols) {
    $format = '%'.(2 + strlen($limit)).'d';

    $rows = ceil($limit / $cols);

    for($r = 0; $r < $rows; $r++) {
        $stack = [];
        for ($c = 0; $c < $cols; $c++) {
            $stack[] = $r + ($rows * $c) + (($c > $limit % $cols) ? 0 : 1);
        }

        $colsInRow = ($r == $rows - 1 && $limit % $cols != 0) ? $limit % $cols : $cols;
        yield call_user_func_array('sprintf', array_merge([str_repeat($format, $colsInRow)], $stack));
    }
}


if(!isset($argv[1]) || !isset($argv[2])) {
    die("Usage: php columns.php <LIMIT> <COLS>\n");
}

foreach(columns(intval($argv[1]), intval($argv[2])) AS $row) {
    echo $row."\n";
}
