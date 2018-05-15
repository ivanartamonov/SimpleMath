<?php

namespace SimpleMath\matrix;

class Vector
{
	
	private $vector;
	private $size;

	public function __construct(array $vector)
	{
		$this->vector = $vector;
		$this->size = count($vector);
	}

	public function plus(Vector $v2): Vector
    {
        if ($this->size !== $v2->size()) {
            throw new \ErrorException('Vectors must have equal size');
        }

        $res = [];
        for ($i=0; $i<$this->size; $i++) {
            $res[] = $this->vector[$i] + $v2->getValue($i);
        }

        return new self($res);
    }
	
	public function multiplyScalar($scalar): Vector
	{
		$res = [];
		
		for($i=0; $i<$this->size; $i++) {
			$res[] = $this->vector[$i] * $scalar;
		}
		
		return new Vector($res);
	}
	
	public function multiplyVector(Vector $vec): Vector
	{
		if($vec->size !== $this->size) {
			echo 'Векторы несовместимы';
			exit;
		}
		
		$res = [];
		$v2 = $vec->asArray();
		for($i=0; $i < $this->size; $i++) {
			$res[] = $this->vector[$i] * $v2[$i];
		}
		
		return new Vector($res);
	}
	
	public function asArray(): array
	{
		return $this->vector;
	}
	
	public function size(): int
	{
		return $this->size;
	}

	public function getValue(int $index)
    {
        return $this->vector[$index];
    }
	
	public function printVector()
	{
		echo implode(', ', $this->vector) . "\n";
	}
	
}