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

    public function testGetValue()
    {
        $data = [
            [1,2,3],
            [4,5,6],
            [7,8,9],
        ];
        $m = new Matrix($data);

        $this->assertEquals(4, $m->getValue(1, 0));
        $this->assertEquals(8, $m->getValue(2, 1));
    }

    public function testGetCol(): void
    {
        $data = [
            [1,1,5,1],
            [1,1,6,1],
            [1,1,7,1],
        ];

        $m = new Matrix($data);
        $this->assertEquals([5,6,7], $m->getCol(2));
    }

    public function testIsSquare()
    {
        $data = [
            [1,1,5,1],
            [1,1,6,1],
            [1,1,7,1],
        ];
        $m = new Matrix($data);
        $this->assertFalse($m->isSquare());

        $data = [
            [1,1],
            [1,1],
        ];
        $m = new Matrix($data);
        $this->assertTrue($m->isSquare());
    }

    public function testAsArray(): void
    {
        $data = [
            [1,1,5,1],
            [1,1,6,1],
            [1,1,7,1],
        ];

        $m = new Matrix($data);
        $this->assertEquals($data, $m->asArray());
    }

    public function testMinus()
    {
        $data1 = [
            [2,5],
            [6,7],
        ];
        $data2 = [
            [1,2],
            [3,4],
        ];
        $data3 = [
            [1,3],
            [3,3],
        ];

        $m1 = new Matrix($data1);
        $m2 = new Matrix($data2);
        $m3 = new Matrix($data3);

        $this->assertEquals($m3, $m1->minus($m2));
    }


    public function testPlus()
    {
        $data1 = [
            [2,5],
            [6,7],
        ];
        $data2 = [
            [1,2],
            [3,4],
        ];
        $data3 = [
            [3,7],
            [9,11],
        ];

        $m1 = new Matrix($data1);
        $m2 = new Matrix($data2);
        $m3 = new Matrix($data3);

        $this->assertEquals($m3, $m1->plus($m2));
    }


    public function testMultiplyScalar(): void
    {
        $data = [
            [1,2,3],
            [4,5,6],
            [7,8,9],
        ];

        $res = [
            [2,4,6],
            [8,10,12],
            [14,16,18],
        ];

        $m = new Matrix($data);
        $m2 = new Matrix($res);
        $this->assertEquals($m2, $m->multiplyScalar(2));
    }

    /**
     * @param $a
     * @param $b
     * @param $c
     * @dataProvider multiplyMatrix
     */
    public function testMultiplyMatrix($a, $b, $c)
    {
        $m1 = new Matrix($a);
        $m2 = new Matrix($b);
        $res = new Matrix($c);
        $this->assertEquals($res, $m1->multiplyMatrix($m2));
    }

    public function multiplyMatrix()
    {
        return [
            // Case 1
            [
                [
                    [1,2,3],
                    [4,5,6],
                    [7,-1,-2],
                ],
                [
                    [6,5,4],
                    [3,2,1],
                    [0,-1,-2],
                ],
                [
                    [12,6,0],
                    [39,24,9],
                    [39,35,31],
                ]
            ],


            // Case 2
            [
                [
                    [1,2,3],
                    [4,5,-1]
                ],
                [
                    [1,2,3,4],
                    [4,3,2,1],
                    [0,-1,-2,-3],
                ],
                [
                    [9,5,1,-3],
                    [24,24,24,24],
                ]
            ],
        ];
    }


    public function testTranspose()
    {
        $before = [
            [1,2,3],
            [4,5,6]
        ];
        $after = [
            [1,4],
            [2,5],
            [3,6],
        ];

        $m1 = new Matrix($before);
        $m2 = new Matrix($after);

        $this->assertEquals($m2, $m1->transpose());
    }
}