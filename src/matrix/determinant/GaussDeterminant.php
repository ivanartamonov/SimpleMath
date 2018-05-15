<?php

namespace SimpleMath\matrix\determinant;

use SimpleMath\matrix\InvalidMatrixException;
use SimpleMath\matrix\Vector;

/**
 * Вычисляет определитель матрицы по методу Гаусса
 *
 *  1. Приводим матрицу к ступенчатому виду.
 *     Для этого пользуемся правилом: Операция добавления к одной из строк матрицы другой строки,
 *     умноженной на некоторое число, не меняет определитель
 *  2. Возвращаем произведение главной диагонали
 *
 *
 * @package SimpleMath\matrix\determinant
 */
class GaussDeterminant extends AbstractMatrixDeterminant
{

    public function det()
    {
        for ($i = 1; $i < $this->matrix->getRows(); $i++) {
            $diagonalIndex = $this->matrix->getCols() - ($this->matrix->getCols() - $i);
            for ($j = 0; $j < $diagonalIndex; $j++) {
                $sourceCoordinate = $this->getSourceValueCoordinate($i, $j);
                $a = $this->matrix->getValue($sourceCoordinate[0], $sourceCoordinate[1]);
                $b = $this->matrix->getValue($i, $j);
                $multiplier = $this->getMultiplier($a, $b);

                $this->transformRow($sourceCoordinate[0], $i, $multiplier);
            }
        }

        return $this->getDiagonalMultiplication();
    }

    /**
     * Получает координаты значения, которое нужно превратить в ноль
     * и ищет координаты значения, которое мы будем для этого использовать
     * (умножать на какое-то число и добавлять ко второму, чтобы занулить его)
     *
     * @param int $valueToZeroRow
     * @param int $valueToZeroCol
     * @return array
     * @throws InvalidMatrixException
     */
    private function getSourceValueCoordinate(int $valueToZeroRow, int $valueToZeroCol): array
    {
        for ($i = $valueToZeroRow - 1; $i >= 0; $i--) {
            $val = $this->matrix->getValue($i, $valueToZeroCol);
            if ($val !== 0) {
                return [$i, $valueToZeroCol];
            }
        }

        throw new InvalidMatrixException();
    }

    /**
     * Определяет, насколько нужно умножить одно число
     * чтобы при его сложении со вторым числом,
     * последнее стало = 0
     *
     * @param number $a - число, которое нужно домножить на Х и прибавить к $b
     * @param number $b - число, которое нам нужно превратить в ноль
     * @return number
     */
    private function getMultiplier($a, $b)
    {
        $x = 0 - $b;
        return $x / $a;
    }

    /**
     * @param int $sourceRowIndex - номер строки, которую умножаем на некоторое число
     * @param int $rowIndex - номер строки, которую нужно трансформировать прибавив к ней первую строку
     * @param $multiplier - множитель, на который умножается первая строка
     */
    private function transformRow(int $sourceRowIndex, int $rowIndex, $multiplier)
    {
        $transformVector = new Vector($this->matrix->getRow($rowIndex));
        $sourceVector = new Vector($this->matrix->getRow($sourceRowIndex));

        $sourceVector = $sourceVector->multiplyScalar($multiplier);
        $transformVector = $transformVector->plus($sourceVector);

        $transformedRow = $transformVector->asArray();
        $this->matrix->setRow($rowIndex, $transformedRow);
    }

    /**
     * @return number - Произведение главной диагонали
     */
    private function getDiagonalMultiplication()
    {
        $result = $this->matrix->getValue(0, 0);

        for ($i = 0; $i < $this->matrix->getRows(); $i++) {
            $result *= $this->matrix->getValue($i, $i);
        }

        return $result;
    }
}