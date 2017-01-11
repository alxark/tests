<?php
/**
 * Есть пары скобок { } [ ] < > ( ), необходимо сделать валидацию вложенности скобок, а именно
 * ( текст ) { } - валидно
 * ( [ ) ] - не валидно
 * ( } - не валидно
 * ) ( - не валидно
 */

function validate($string) {
    $stack = [];
    $pairs = [
        "]" => "[",
        "}" => "{",
        ")" => "(",
        ">" => "<"
    ];
    foreach (explode("", $string) AS $letter) {
        if (in_array($letter, array_values($pairs))) {
            $stack[] = $letter;
        } elseif (in_array($letter, array_keys($pairs))) {
            if (sizeof($stack) == 0) return false;

            $last = array_pop($stack);

            if ($last != $pairs[$letter]) {
                return false;
            }
        }
    }

    if (sizeof($stack) > 0) return false;

    return true;
}
