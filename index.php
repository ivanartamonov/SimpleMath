<?php

require __DIR__ . '/vendor/autoload.php';

$data = [
    [1,2,3],
    [3,2,5],
    [-1,4,-2],
];

$m = new \SimpleMath\matrix\Matrix($data);
$determinant = new \SimpleMath\matrix\determinant\SarrusDeterminant($m);

$determinant->det();