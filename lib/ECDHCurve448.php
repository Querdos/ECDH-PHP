<?php

namespace Querdos\lib;
use Querdos\Util\MathUtil;


/**
 * Class Curve448
 * @package Querdos\lib
 * @author  Hamza ESSAYEGH <hamza.essayegh@protonmail.com>
 */
class ECDHCurve448 extends ECDH
{
    /**
     * Curve448 constructor.
     */
    public function __construct()
    {
        // setting domain parameters
        $this->dp = new DomainParameters();
        $this->dp
            ->setP(gmp_sub(
                gmp_sub(
                    gmp_pow('2', '448'),
                    gmp_pow('2', '224')
                ),
                gmp_init(1)
            ))
            ->setA(gmp_init('156326'))
            ->setN(gmp_sub(
                gmp_pow('2', '446'),
                gmp_init('8335dc163bb124b65129c96fde933d8d723a70aadc873d6d54a7bb0d', 16)
            ))
            ->setH(gmp_init(4))
            ->setG(array(
                gmp_init(5),
                gmp_init('355293926785568175264127502063783334808976399387714271831880898435169088786967410002932673765864550910142774147268105838985595290606362')
            ))
        ;

        // generating private key
        $this->private = gmp_random_range(
            gmp_init(1),
            gmp_sub($this->dp->getN(), gmp_init(1))
        );

        // generating public key
        $this->public = MathUtil::scalar_mult($this->private, $this->dp->getG());
    }

}