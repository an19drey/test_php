<?php
/*

    *
   ***
  *****
 *******
*********

Write a script to output this pyramid on console (with leading spaces)

*/

/**
 * @param string $symbol
 * @param int $height
 * @return bool
 */
function pyramid(string $symbol, int $height)
{
    if ($height <= 0 || strlen($symbol) > 1) {
        return false;
    }

    for ($i = 1; $i <= $height; $i++) {
        $symbolCount = $i + $i - 1;
        $length = $height + $i - 1;

        $str = sprintf(
            "% ". $length . "s",
            sprintf("%'" . $symbol . $symbolCount . "s", $symbol)
        );

        printf("%s\n", $str);
    }

    return true;
}

pyramid('*', 10);
