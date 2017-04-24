<?php

namespace Querdos\Lib;

/**
 * Class ECDH
 * @package Querdos\Lib
 * @author  Hamza ESSAYEGH <hamza.essayegh@protonmail.com>
 */
class ECDH
{
    const SECP192K1 = 'secp192k1';
    const SECP192R1 = 'secp192r1';
    const SECP224K1 = 'secp224k1';
    const SECP224R1 = 'secp224r1';
    const SECP256K1 = 'secp256k1';
    const SECP256R1 = 'secp256r1';
    const SECP384R1 = 'secp384r1';
    const SECP521R1 = 'secp521r1';

    /**
     * @var \GMP[]
     */
    private $domain_parameters;

    /**
     * @var \GMP
     */
    private $private;

    /**
     * @var \GMP[]
     */
    private $public;

    /**
     * @var \GMP[]
     */
    private $secret;

    /**
     * ECDH constructor.
     *
     * @param string $standard
     */
    public function __construct($standard = self::SECP256K1)
    {
        // setting domain parameters
        $this->domain_parameters = call_user_func(SecpUtil::class . '::' . $standard);

        // private key generation
        $this->private = gmp_random_range(
            gmp_init(1),
            gmp_sub($this->domain_parameters['n'], gmp_init(1))
        );

        // public key generation
        $this->public  = array(
            gmp_mul($this->private, $this->domain_parameters['x_g']), gmp_mul($this->private, $this->domain_parameters['y_g'])
        );
    }

    public function computeSecret($public_external)
    {
        $this->secret = array(
            gmp_mul($this->private, $public_external[0]),
            gmp_mul($this->private, $public_external[1])
        );
    }

    /**
     * @return \GMP[]
     */
    public function getDomainParameters()
    {
        return $this->domain_parameters;
    }

    /**
     * @param \GMP[] $domain_parameters
     *
     * @return ECDH
     */
    public function setDomainParameters($domain_parameters)
    {
        $this->domain_parameters = $domain_parameters;
        return $this;
    }

    /**
     * @return \GMP
     */
    public function getPrivate()
    {
        return $this->private;
    }

    /**
     * @param \GMP $private
     *
     * @return ECDH
     */
    public function setPrivate($private)
    {
        $this->private = $private;
        return $this;
    }

    /**
     * @return \GMP[]
     */
    public function getPublic()
    {
        return $this->public;
    }

    /**
     * @param \GMP[] $public
     *
     * @return ECDH
     */
    public function setPublic($public)
    {
        $this->public = $public;
        return $this;
    }

    /**
     * @return \GMP[]
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param \GMP[] $secret
     *
     * @return ECDH
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
        return $this;
    }
}