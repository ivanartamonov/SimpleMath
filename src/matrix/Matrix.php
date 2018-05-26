<?php

namespace SimpleMath\matrix;

use SimpleMath\matrix\determinant\GaussDeterminant;

class Matrix
{
    public const DET_GAUSS = 1;

    private $matrix;
    private $cols;
    private $rows;

    public function __construct(array $matrix)
    {
        $this->matrix = $matrix;
        $this->rows = count($matrix);
        $this->cols = count($matrix[0]);
    }

    public function getCols(): int
    {
        return $this->cols;
    }

    public function getRows(): int
    {
        return $this->rows;
    }

    public function printMatrix()
    {
        for ($i = 0; $i < $this->rows; $i++) {
            echo implode(', ', $this->matrix[$i]);
            echo "\n";
        }
    }

    public function getValue($rowIndex, $colIndex)
    {
        return $this->matrix[$rowIndex][$colIndex];
    }


    public function minus(Matrix $m): Matrix
    {
        $res = [];
        for ($i = 0; $i < $this->rows; $i++) {
            for ($j = 0; $j < $this->cols; $j++) {
                $res[$i][$j] = $this->matrix[$i][$j] - $m->getValue($i, $j);
            }
        }

        return new Matrix($res);
    }

    public function plus(Matrix $m): Matrix
    {
        $res = [];
        for ($i = 0; $i < $this->rows; $i++) {
            for ($j = 0; $j < $this->cols; $j++) {
                $res[$i][$j] = $this->matrix[$i][$j] + $m->getValue($i, $j);
            }
        }

        return new Matrix($res);
    }

    public function multiplyScalar($scalar): Matrix
    {
        $res = [];
        for ($i = 0; $i < $this->rows; $i++) {
            for ($j = 0; $j < $this->cols; $j++) {
                $res[$i][$j] = $this->matrix[$i][$j] * $scalar;
            }
        }

        return new Matrix($res);
    }

    public function multiplyMatrix(Matrix $matrix): Matrix
    {
        $res = [];
        for ($i = 0; $i < $this->rows; $i++) {
            for ($j = 0; $j < $matrix->cols; $j++) {
                $rowVector = new Vector($this->matrix[$i]);
                $colVector = new Vector($matrix->getCol($j));
                $res[$i][$j] = array_sum($rowVector->multiplyVector($colVector)->asArray());
            }
        }

        return new Matrix($res);
    }

    public function isSquare(): bool
    {
        return $this->rows === $this->cols;
    }

    public function getCol(int $index): array
    {
        $col = [];
        for ($i = 0; $i < $this->rows; $i++) {
            $col[] = $this->matrix[$i][$index];
        }
        return $col;
    }

    public function getRow(int $index): array
    {
        return $this->matrix[$index];
    }

    public function setRow(int $index, array $newRow)
    {
        $this->matrix[$index] = $newRow;
    }

    public function asArray(): array
    {
        return $this->matrix;
    }

    public function transpose(): Matrix
    {
        $data = [];

        for ($i = 0; $i < $this->rows; $i++) {
            for ($j = 0; $j < $this->cols; $j++) {
                $data[$j][$i] = $this->matrix[$i][$j];
            }
        }

        return new Matrix($data);
    }

    public function det($method = self::DET_GAUSS)
    {
        switch ($method) {
            case self::DET_GAUSS:
                $det = new GaussDeterminant($this);
                break;
            default:
                $det = new GaussDeterminant($this);
        }

        return $det->det();
    }

}