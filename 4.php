<?php

$lines = file('4.txt', FILE_IGNORE_NEW_LINES);

// 4A
$out = 0;
foreach ($lines as $i => $line) {
    // $out += 2**(count(array_intersect(preg_split('/\s+/', trim(substr($line, 10, strpos($line, ' | ')-10))), preg_split('/\s+/', trim(substr($line, strpos($line, ' | '))))))-1);
    // no wait
    $wins = preg_split('/\s+/', trim(substr($line, $pos = strpos($line, ':'), strpos($line, '|') - $pos)));
    $ours = preg_split('/\s+/', trim(substr($line, strpos($line, '|')+1)));
    if ($match = array_intersect($wins, $ours)) $out += 2**(count($match)-1);
}
echo $out;