<?php

namespace SimpleMath\matrix\determinant;

use SimpleMath\matrix\Matrix;

/**
 * Вычисляет определитель матрицы по методу Саррюса
 *
 * 1. Достраиваем "воображаемые" колонки справа от матрицы так, чтоб от каждого столбца реальной матрицы
 *    можно было провести главную дигональ.
 * 2. Вычисляем произведение всех главных и "не главных" диагоналей
 * 3. Суммируем отдельно произведения главных и "не главных" диагоналей
 * 4. Вычитает от суммы произведений главных сумму произведений "не главных" диагоналей
 *
 */
class SarrusDeterminant extends AbstractMatrixDeterminant
{
    /** @var Matrix */
    private $newMatrix;

    /**
     * @return number
     */
    public function det()
    {
        $this->newMatrix = $this->addAdditionalColumns();

        $positiveDiagonals = [];
        for ($i=0; $i < $this->matrix->getCols(); $i++) {
            $d = $this->getPositiveDiagonal($i);
            $d = $this->multiplyArrayValues($d);
            $positiveDiagonals[] = $d;
        }

        $negativeDiagonals = [];
        $startColIndex = $this->matrix->getCols() - 1;
        for ($i=$startColIndex; $i < $this->newMatrix->getCols(); $i++) {
            $d = $this->getNegativeDiagonal($i);
            $d = $this->multiplyArrayValues($d);
            $negativeDiagonals[] = $d;
        }

        $positiveDiagonalsSum = array_sum($positiveDiagonals);
        $negativeDiagonalsSum = array_sum($negativeDiagonals);

        return $positiveDiagonalsSum - $negativeDiagonalsSum;
    }

    private function addAdditionalColumns(): Matrix
    {
        $arr = $this->matrix->asArray();
        $totalRows = $this->matrix->getRows() - 1;

        foreach ($arr as $row => $rowValue) {
            for($col=0; $col < $totalRows; $col++) {
                $arr[$row][] = $arr[$row][$col];
            }
        }

        return new Matrix($arr);
    }

    private function getPositiveDiagonal($columnIndex): array
    {
        $elementsInDiagonalCount = $this->matrix->getCols();
        $lastColIndex = $columnIndex + $elementsInDiagonalCount;
        $diagonalValues = [];

        for($i=$columnIndex, $rowIndex=0; $i<$lastColIndex; $i++, $rowIndex++) {
            $diagonalValues[] = $this->newMatrix->getValue($rowIndex, $i);
        }

        return $diagonalValues;
    }

    private function getNegativeDiagonal($columnIndex): array
    {
        $elementsInDiagonalCount = $this->matrix->getCols();
        $lastColIndex = $columnIndex - $elementsInDiagonalCount;
        $diagonalValues = [];

        for($i=$columnIndex, $rowIndex=0; $i>$lastColIndex; $i--, $rowIndex++) {
            $diagonalValues[] = $this->newMatrix->getValue($rowIndex, $i);
        }

        return $diagonalValues;
    }

    private function multiplyArrayValues(array $arr)
    {
        $res = 1;
        foreach ($arr as $item) {
            $res *= $item;
        }
        return $res;
    }
}