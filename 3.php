<?php

$lines = file('3.txt', FILE_IGNORE_NEW_LINES);

$out = 0;
// I'm gonna treat it as a grid problem, so I'm just gonna find the numbers with their offsets, and then check above, sides, and below for any non-[.0-9]
foreach ($lines as $i => $line) {
    preg_match_all('/\d+/', $line, $matches, PREG_OFFSET_CAPTURE);
    foreach($matches[0] as $match) {
        list($number, $offset) = $match;
        $area = ($i>0 ? substr($lines[$i-1], max($offset-1, 0), strlen($number)+2) : '').
        ($offset>0 ? $line[$offset-1] : '').substr($line, $offset+strlen($number), 1).
        ($i<count($lines)-1 ? substr($lines[$i+1], max($offset-1, 0), strlen($number)+2) : '');
        if (strlen(preg_replace('/[.0-9]/', '', $area))) $out += $number;
    }
}
echo $out;