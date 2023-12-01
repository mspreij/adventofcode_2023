#!/usr/bin/env php
<?php

$lines = file('1.txt', FILE_IGNORE_NEW_LINES);

// 1A
// foreach ($lines as $line) {
// 	$ints = preg_replace('/[a-z]/', '', $line);
// 	$out[] = $ints[0] . $ints[strlen($ints)-1];
// }
// echo array_sum($out);

// 1B
// I *thought* that input looked sus
$text_nums = [1 => 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
$nums = array_merge(range(1, 9), $text_nums);

foreach ($lines as $line) {
	$min = 100;
	$max = -1;
	foreach ($nums as $num) {
		$posf = strpos($line, $num);
		$posl = strrpos($line, $num);
		if (is_numeric($posf)) {
			if ($posf < $min) list($min, $first) = [$posf, $num];
		}
		if (is_numeric($posl)) {
			if ($posl > $max) list($max, $last) = [$posl, $num];
		}
	}
	if (! is_numeric($first)) $first = array_search($first, $text_nums);
	if (! is_numeric($last))  $last  = array_search($last, $text_nums);
	// echo "$line  $first$last\n";
	$out[] = $first.$last;
}
echo array_sum($out);