<?php

namespace SimpleMath\Tests\matrix;

use SimpleMath\matrix\determinant\GaussDeterminant;
use SimpleMath\matrix\Matrix;
use PHPUnit\Framework\TestCase;

class MatrixDeterminantTest extends TestCase
{

    public function testGauss()
    {
        $data = [
            [1,2,3],
            [3,2,5],
            [-1,4,-2],
        ];

        $m = new Matrix($data);
        $determinant = new GaussDeterminant($m);

        $this->assertEquals(20, $determinant->det());
    }

}