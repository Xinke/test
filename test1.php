<?php
/**
 * Нужно написать код, который из массива выведет то что приведено ниже в комментарии.
 */
$x = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'];

/*
print_r($x) - должен выводить это:
Array
(
    [h] => Array
        (
            [g] => Array
                (
                    [f] => Array
                        (
                            [e] => Array
                                (
                                    [d] => Array
                                        (
                                            [c] => Array
                                                (
                                                    [b] => Array
                                                        (
                                                            [a] =>
                                                        )

                                                )

                                        )

                                )

                        )

                )

        )

);*/

function mutateArray($x) {
    $newX = array();
    $link = &$newX;
    for ($i = count($x) - 1; $i >= 0; $i--) { 
        $link[ $x[$i] ] = false;
        $link = &$link[ $x[$i] ];
    }
    unset($link);
    return $newX;
}
$x = mutateArray($x);
print_r($x);