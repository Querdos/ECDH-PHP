<?php

namespace Querdos\Lib;

/**
 * Class MathUtil
 * @package Querdos\Lib
 * @author  Hamza ESSAYEGH <hamza.essayegh@protonmail.com>
 */
class MathUtil
{
    /**
     * @param \GMP   $k
     * @param \GMP[] $v
     *
     * @return \GMP[]
     */
    public static function scalar_mult($k, array $v)
    {
        return array(
            gmp_mul($k, $v[0]),
            gmp_mul($k, $v[1])
        );
    }

    /**
     * @param \GMP[] $v1
     * @param \GMP[] $v2
     *
     * @return array
     */
    public static function add_vector(array $v1, array $v2)
    {
        return array(
            gmp_add($v1[0], $v2[0]),
            gmp_add($v1[1], $v2[1])
        );
    }
}