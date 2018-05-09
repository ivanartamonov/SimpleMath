<?php

namespace SimpleMath;

class Vector
{
	
	private $vector;
	private $size;

	public function __construct(array $vector)
	{
		$this->vector = $vector;
		$this->size = count($vector);
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
	
	public function printVector()
	{
		echo implode(', ', $this->vector) . "\n";
	}
	
}