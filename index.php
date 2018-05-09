<?php

require __DIR__ . '/vendor/autoload.php';

use SimpleMath\Matrix;

$dataA = [
	[1, 2, 3],
	[3, 4, 5],
];

$dataB = [
	[2, 3],
	[4, 5],
	[2, 3],
];

$A = new Matrix($dataA);
$B = new Matrix($dataB);

$C = $A->multiplyMatrix($B);
$C->printMatrix();