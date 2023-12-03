<?php

/*
Determine which games would have been possible if the bag had been loaded with only
12 red cubes, 13 green cubes, and 14 blue cubes. What is the sum of the IDs of those games?
*/

$lines = file('2.txt', FILE_IGNORE_NEW_LINES);
$linesz = explode("\n", "Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green
Game 2: 1 blue, 2 green; 3 green, 4 blue, 1 red; 1 green, 1 blue
Game 3: 8 green, 6 blue, 20 red; 5 blue, 4 red, 13 green; 5 green, 1 red
Game 4: 1 green, 3 red, 6 blue; 3 green, 6 red; 3 green, 15 blue, 14 red
Game 5: 6 red, 1 blue, 3 green; 2 blue, 1 red, 2 green");

// 2A
// Game 1: 1 blue, 1 red; 10 red; 8 red, 1 blue, 1 green; 1 green, 5 blue
foreach ($lines as $line) {
    $id = substr($line, 5, ($pos = strpos($line, ':'))-5);
    $red = $green = $blue = 0;
    foreach(explode('; ', substr($line, $pos+2)) as $turn) {
        foreach(explode(', ', $turn) as $pair) { // gdi my regex sucks
            list($num, $color) = explode(' ', $pair);
            $$color = max($$color, $num);
        }
    }
    $out[$id] = [$red, $green, $blue];
}

$max_red = 12;
$max_green = 13;
$max_blue = 14;
$out = array_filter($out, fn($t) => $t[0] <= $max_red and $t[1] <= $max_green and $t[2] <= $max_blue);
echo array_sum(array_keys($out));