<?php

$result = simplexml_load_file('omtest.xml');

print_r($result);
echo "\n=========================\n";
$int = (int) $result->OMATTR->OMA->OMI;
print_r($int);
echo "\n=========================\n";
echo gettype($int), "\n";
?>