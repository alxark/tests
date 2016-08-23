<?php
/**
 * Заполнить матрицу X на Y уникальными случайными числами в интервале от 1 до X*Y.
 * Вывести матрицу на экран, а так же суммы чисел по столбцам и по строкам.
 * matrix(5 ,7); 
 * 1  16   3   4  20   6   7  | 57 
 * 8   9  10  33  12  13  14  | 99 
 * 15   2  17  26  19   5  21 | 105 
 * 22  29  24  25  18  27  28 | 173 
 * 23  30  31  32  11  34  35 | 196
 *  --- --- --- --- --- --- --- 
 * 69  86  85 120  80  85 105
 */

function matrix($limitX, $limitY) {
    $colSums = array_fill(0, $limitX, 0);

    for($y = 0; $y < $limitY; $y++) {
        $stack = [];
        for($x = 0; $x < $limitX; $x++) {
            $number = rand(1, $limitX * $limitY);
            $stack[] = $number;
            $colSums[$x] += $number;
        }

        $lineFormat = str_repeat('%4s ', $limitX).' | '.array_sum($stack);
        yield call_user_func_array('sprintf', array_merge([$lineFormat], $stack));
    }
    yield str_repeat('-', 5 * $limitX);
    yield call_user_func_array('sprintf', array_merge([str_repeat('%4s ', $limitX)], $colSums));
}


if(!isset($argv[1]) || !isset($argv[2])) {
    die("Usage: php matrix.php <X> <Y>\n");
}

$limitX = intval($argv[1]);
$limitY = intval($argv[2]);

foreach(matrix($limitX, $limitY) as $line) {
    echo $line."\n";
}