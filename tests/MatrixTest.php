<?php

namespace SimpleMath\Tests;

use SimpleMath\Matrix;
use PHPUnit\Framework\TestCase;

class MatrixTest extends TestCase
{

    /**
     * @dataProvider sizeDataProvider
     * @param $data
     * @param $rows
     * @param $cols
     */
    public function testSize($data, $rows, $cols): void
    {
        $m = new Matrix($data);
        $this->assertEquals($cols, $m->getCols());
        $this->assertEquals($rows, $m->getRows());
    }

    public function sizeDataProvider(): array
    {
        return [
            [
                [
                    [1,1],
                    [1,1]
                ],
                2,2
            ],
            [
                [
                    [1,1,1],
                    [1,1,1]
                ],
                2,3
            ],
            [
                [
                    [1,1],
                    [1,1],
                    [1,1]
                ],
                3,2
            ],
            [
                [
                    [1,1,1],
                    [1,1,1],
                    [1,1,1]
                ],
                3,3
            ]
        ];
    }
}