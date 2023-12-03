<?php

$lines = file('3.txt', FILE_IGNORE_NEW_LINES);

// $out = 0;
// I'm gonna treat it as a grid problem, so I'm just gonna find the numbers with their offsets, and then check above, sides, and below for any non-[.0-9]
// foreach ($lines as $i => $line) {
//     preg_match_all('/\d+/', $line, $matches, PREG_OFFSET_CAPTURE);
//     foreach($matches[0] as $match) {
//         list($number, $offset) = $match;
//         $area = ($i>0 ? substr($lines[$i-1], max($offset-1, 0), strlen($number)+2) : '').
//         ($offset>0 ? $line[$offset-1] : '').substr($line, $offset+strlen($number), 1).
//         ($i<count($lines)-1 ? substr($lines[$i+1], max($offset-1, 0), strlen($number)+2) : '');
//         if (strlen(preg_replace('/[.0-9]/', '', $area))) $out += $number;
//     }
// }
// echo $out;

// 3B
// quick visual inspection reveals at least no * on the first or last line so that's two edge-cases I can ignore.
// first gonna store all numbers' positions
$out = 0;
foreach ($lines as $i => $line) {
    preg_match_all('/\d+/', $line, $matches, PREG_OFFSET_CAPTURE);
    $numbers[$i] = $matches[0];
}
foreach ($lines as $i => $line) {
    if ($i == 0 or $i == count($lines)-1) continue;
    preg_match_all('/\*/', $line, $matches, PREG_OFFSET_CAPTURE);
    $stars = $matches[0];
    if (! $stars) continue;
    foreach ($stars as $star) {
        $adjacent = [];
        $star = $star[1]; // only interested in the position
        foreach ($numbers[$i-1] as $number) {
            // previous line neighbours
            if ($number[1]<=$star+1 and ($number[1]+strlen($number[0])) >= $star) { // kinda like collision detection?
                $adjacent[] = $number[0];
            }
        }
        foreach ($numbers[$i] as $number) {
            // same line neighbours
            if ($number[1]+strlen($number[0]) == $star or $number[1] == $star+1) {
                $adjacent[] = $number[0];
            }
        }
        foreach ($numbers[$i+1] as $number) {
            // next line neighbours
            if ($number[1]<=$star+1 and ($number[1]+strlen($number[0])) >= $star) {
                $adjacent[] = $number[0];
            }
        }
        if (count($adjacent) == 2) $out += array_product($adjacent);
    }
}
echo $out;