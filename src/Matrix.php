<?php

namespace SimpleMath;

class Matrix {

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
		for($i=0; $i<$this->rows; $i++) {
			echo implode(', ', $this->matrix[$i]);
			echo "\n";
		}
	}
	
	public function multiplyScalar($scalar): Matrix
	{
		$res = [];
		for ($i=0; $i < $this->rows; $i++) {
			for ($j=0; $j < $this->cols; $j++) {
				$res[$i][$j] = $this->matrix[$i][$j] * $scalar;
			}
		}
		
		return new Matrix($res);
	}
	
	public function multiplyMatrix(Matrix $matrix): Matrix
	{
		if($this->rows !== $matrix->cols) {
			echo "Матрицы не согласованы!\n";
			exit;
		}

		$res = [];
		for ($i=0; $i < $this->rows; $i++) {
			for ($j=0; $j < $this->cols; $j++) {
				$rowVector = new Vector($this->matrix[$i]);
				$colVector = new Vector($matrix->getCol($j));
				$res[$i][$j] = array_sum($rowVector->multiplyVector($colVector)->asArray());
			}
		}
		
		return new Matrix($res);
	}
	
	public function getCol(int $index): array
    {
		$col = [];
		for($i=0; $i<$this->rows; $i++) {
			$col[] = $this->matrix[$i][$index];
		}
		return $col;
	}
	
	public function asArray(): array
	{
		return $this->matrix;
	}

}