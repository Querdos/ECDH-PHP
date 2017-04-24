<?php

namespace Querdos\tests;
use Querdos\Lib\ECDH;

/**
 * Class ECDHTest
 * @package ${NAMESPACE}
 * @author  Hamza ESSAYEGH <hamza.essayegh@protonmail.com>
 */
class ECDHTest extends \PHPUnit_Framework_TestCase
{
    public static function setUpBeforeClass()
    {
        require 'autoloader.php';
    }

    public function testSECP192K1()
    {
        $ecdh_alice = new ECDH(ECDH::SECP192K1);
        $ecdh_bob   = new ECDH(ECDH::SECP192K1);

        $ecdh_bob->computeSecret($ecdh_alice->getPublic());
        $ecdh_alice->computeSecret($ecdh_bob->getPublic());

        $this->assertEquals(1, gmp_cmp($ecdh_bob->getSecret()[0], $ecdh_alice->getSecret()[0]));
        $this->assertEquals(0, gmp_cmp($ecdh_bob->getSecret()[1], $ecdh_alice->getSecret()[1]));
    }

    public function testSECP192R1()
    {
        $ecdh_alice = new ECDH(ECDH::SECP192R1);
        $ecdh_bob   = new ECDH(ECDH::SECP192R1);

        $ecdh_bob->computeSecret($ecdh_alice->getPublic());
        $ecdh_alice->computeSecret($ecdh_bob->getPublic());

        $this->assertEquals(0, gmp_cmp($ecdh_bob->getSecret()[0], $ecdh_alice->getSecret()[0]));
        $this->assertEquals(0, gmp_cmp($ecdh_bob->getSecret()[1], $ecdh_alice->getSecret()[1]));
    }

    public function testSECP224K1()
    {
        $ecdh_alice = new ECDH(ECDH::SECP224K1);
        $ecdh_bob   = new ECDH(ECDH::SECP224K1);

        $ecdh_bob->computeSecret($ecdh_alice->getPublic());
        $ecdh_alice->computeSecret($ecdh_bob->getPublic());

        $this->assertEquals(0, gmp_cmp($ecdh_bob->getSecret()[0], $ecdh_alice->getSecret()[0]));
        $this->assertEquals(0, gmp_cmp($ecdh_bob->getSecret()[1], $ecdh_alice->getSecret()[1]));
    }

    public function testSECP224R1()
    {
        $ecdh_alice = new ECDH(ECDH::SECP224R1);
        $ecdh_bob   = new ECDH(ECDH::SECP224R1);

        $ecdh_bob->computeSecret($ecdh_alice->getPublic());
        $ecdh_alice->computeSecret($ecdh_bob->getPublic());

        $this->assertEquals(0, gmp_cmp($ecdh_bob->getSecret()[0], $ecdh_alice->getSecret()[0]));
        $this->assertEquals(0, gmp_cmp($ecdh_bob->getSecret()[1], $ecdh_alice->getSecret()[1]));
    }

    public function testSECP256K1()
    {
        $ecdh_alice = new ECDH(ECDH::SECP256K1);
        $ecdh_bob   = new ECDH(ECDH::SECP256K1);

        $ecdh_bob->computeSecret($ecdh_alice->getPublic());
        $ecdh_alice->computeSecret($ecdh_bob->getPublic());

        $this->assertEquals(0, gmp_cmp($ecdh_bob->getSecret()[0], $ecdh_alice->getSecret()[0]));
        $this->assertEquals(0, gmp_cmp($ecdh_bob->getSecret()[1], $ecdh_alice->getSecret()[1]));
    }

    public function testSECP256R1()
    {
        $ecdh_alice = new ECDH(ECDH::SECP256R1);
        $ecdh_bob   = new ECDH(ECDH::SECP256R1);

        $ecdh_bob->computeSecret($ecdh_alice->getPublic());
        $ecdh_alice->computeSecret($ecdh_bob->getPublic());

        $this->assertEquals(0, gmp_cmp($ecdh_bob->getSecret()[0], $ecdh_alice->getSecret()[0]));
        $this->assertEquals(0, gmp_cmp($ecdh_bob->getSecret()[1], $ecdh_alice->getSecret()[1]));
    }

    public function testSECP384R1()
    {
        $ecdh_alice = new ECDH(ECDH::SECP384R1);
        $ecdh_bob   = new ECDH(ECDH::SECP384R1);

        $ecdh_bob->computeSecret($ecdh_alice->getPublic());
        $ecdh_alice->computeSecret($ecdh_bob->getPublic());

        $this->assertEquals(0, gmp_cmp($ecdh_bob->getSecret()[0], $ecdh_alice->getSecret()[0]));
        $this->assertEquals(0, gmp_cmp($ecdh_bob->getSecret()[1], $ecdh_alice->getSecret()[1]));
    }

    public function testSECP521R1()
    {
        $ecdh_alice = new ECDH(ECDH::SECP521R1);
        $ecdh_bob   = new ECDH(ECDH::SECP521R1);

        $ecdh_bob->computeSecret($ecdh_alice->getPublic());
        $ecdh_alice->computeSecret($ecdh_bob->getPublic());

        $this->assertEquals(0, gmp_cmp($ecdh_bob->getSecret()[0], $ecdh_alice->getSecret()[0]));
        $this->assertEquals(0, gmp_cmp($ecdh_bob->getSecret()[1], $ecdh_alice->getSecret()[1]));
    }
}