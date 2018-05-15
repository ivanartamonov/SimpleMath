<?php

namespace SimpleMath\matrix\determinant;

use SimpleMath\matrix\InvalidMatrixException;
use SimpleMath\matrix\Matrix;

abstract class AbstractMatrixDeterminant
{
    /** @var Matrix */
    protected $matrix;

    /**
     * AbstractMatrixDeterminant constructor.
     * @param Matrix $m
     * @throws InvalidMatrixException
     */
    public function __construct(Matrix $m)
    {
        if(!$m->isSquare()) {
            throw new InvalidMatrixException();
        }

        $this->matrix = $m;
    }

    /**
     * @return number
     */
    abstract public function det();

}