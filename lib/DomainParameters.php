<?php

namespace Querdos\lib;

/**
 * Class DomainParameters
 * @package Querdos\lib
 * @author  Hamza ESSAYEGH <hamza.essayegh@protonmail.com>
 */
class DomainParameters
{
    /**
     * @var \GMP
     */
    private $p;

    /**
     * @var \GMP
     */
    private $a;

    /**
     * @var \GMP
     */
    private $b;

    /**
     * @var \GMP[]
     */
    private $g;

    /**
     * @var \GMP
     */
    private $n;

    /**
     * @var \GMP
     */
    private $h;

    /**
     * DomainParameters constructor.
     *
     * @param \GMP   $p
     * @param \GMP   $a
     * @param \GMP   $b
     * @param \GMP[] $g
     * @param \GMP   $n
     * @param \GMP   $h
     */
    public function __construct(\GMP $p, \GMP $a, \GMP $b, array $g, \GMP $n, \GMP $h)
    {
        $this->p = $p;
        $this->a = $a;
        $this->b = $b;
        $this->g = $g;
        $this->n = $n;
        $this->h = $h;
    }

    /**
     * @return \GMP
     */
    public function getP()
    {
        return $this->p;
    }

    /**
     * @param \GMP $p
     *
     * @return DomainParameters
     */
    public function setP($p)
    {
        $this->p = $p;
        return $this;
    }

    /**
     * @return \GMP
     */
    public function getA()
    {
        return $this->a;
    }

    /**
     * @param \GMP $a
     *
     * @return DomainParameters
     */
    public function setA($a)
    {
        $this->a = $a;
        return $this;
    }

    /**
     * @return \GMP
     */
    public function getB()
    {
        return $this->b;
    }

    /**
     * @param \GMP $b
     *
     * @return DomainParameters
     */
    public function setB($b)
    {
        $this->b = $b;
        return $this;
    }

    /**
     * @return \GMP[]
     */
    public function getG()
    {
        return $this->g;
    }

    /**
     * @param \GMP[] $g
     *
     * @return DomainParameters
     */
    public function setG($g)
    {
        $this->g = $g;
        return $this;
    }

    /**
     * @return \GMP
     */
    public function getN()
    {
        return $this->n;
    }

    /**
     * @param \GMP $n
     *
     * @return DomainParameters
     */
    public function setN($n)
    {
        $this->n = $n;
        return $this;
    }

    /**
     * @return \GMP
     */
    public function getH()
    {
        return $this->h;
    }

    /**
     * @param \GMP $h
     *
     * @return DomainParameters
     */
    public function setH($h)
    {
        $this->h = $h;
        return $this;
    }

}