<?php

namespace Querdos\Lib;
use Querdos\Util\MathUtil;
use Querdos\Util\SecpUtil;

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

    const HASH_ALGO = 'haval256,5';

    /**
     * @var DomainParameters
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
            gmp_sub($this->domain_parameters->getN(), gmp_init(1))
        );

        // public key generation
        $this->public  = MathUtil::scalar_mult($this->private, $this->domain_parameters->getG());
    }

    /**
     * The shared secret is xk (the x coordinate of the point)
     *
     * @param \GMP[] $public_external
     */
    public function computeSecret($public_external)
    {
        $this->secret = MathUtil::scalar_mult($this->private, $public_external)[0];
    }

    /**
     * Sign a given message with private key
     *
     * @param string $message
     *
     * @return ECDHSignature
     */
    public function signMessage($message)
    {
        // creating the signature object
        $sign = new ECDHSignature();

        // hash of the message
        $z = gmp_init(hash(self::HASH_ALGO, $message), 16);

        do {
            // take a random integer k between 1,n-1
            $k = gmp_random_range(gmp_init(1), gmp_sub($this->domain_parameters->getN(), gmp_init(1)));

            // calculate the point P = kG
            $p = MathUtil::scalar_mult($k, $this->domain_parameters->getG());

            // calculate the number r = xp mod n
            $r = gmp_mod($p[0], $this->domain_parameters->getN());

            // if r = 0, choose another k
            if (0 == $r) { continue; }

            // calculate s = k^(-1) * (z + rdA) mod n
            $s   = gmp_invert($k, $this->domain_parameters->getN());
            $rda = gmp_mul($r, $this->private);
            $s   = gmp_mul($s, gmp_add($z, $rda));
        } while (0 == $r && 0 == $s); // if r=0 or s=0, choose another k

        // setting parameters
        $sign
            ->setR($r)
            ->setS($s);
        ;

        return $sign;
    }

    /**
     * Verify a signature with an external public key
     *
     * @param ECDHSignature $sign
     * @param \GMP[]        $pub_ext
     * @param string        $message
     *
     * @return bool
     */
    public function verifySignature(ECDHSignature $sign, $pub_ext, $message)
    {
        // hashing
        $z    = gmp_init(hash(self::HASH_ALGO, $message), 16);

        $sinv = gmp_invert($sign->getS(), $this->domain_parameters->getN());
        $u1   = gmp_mod(gmp_mul($sinv, $z), $this->domain_parameters->getN());
        $u2   = gmp_mod(gmp_mul($sinv, $sign->getR()), $this->domain_parameters->getN());

        $p = MathUtil::add_vector(
            MathUtil::scalar_mult($u1, $this->domain_parameters->getG()),
            MathUtil::scalar_mult($u2, $pub_ext)
        );

        // the signature is valid only if r = xp mod n
        $expected = gmp_mod($p[0], $this->domain_parameters->getN());

        // checking if signature is valid
        return 0 == gmp_cmp($sign->getR(), $expected);
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