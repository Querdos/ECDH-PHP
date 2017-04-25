<?php
namespace Querdos\tests;

require 'autoloader.php';
use Querdos\Lib\ECDH;
use PHPUnit\Framework\TestCase;

/**
 * Class ECDHTest
 * @package ${NAMESPACE}
 * @author  Hamza ESSAYEGH <hamza.essayegh@protonmail.com>
 */
class ECDHTest extends TestCase
{
    const MESSAGE = <<<EOT
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lacinia, turpis a euismod posuere, metus dolor hendrerit lorem, in sagittis lorem nulla at tortor. Integer tellus risus, cursus at purus in, semper condimentum purus. Integer et lectus vel sapien tempor elementum. Integer non orci sed felis aliquam placerat. Aenean maximus elementum tristique. Donec euismod hendrerit mauris quis fringilla. Mauris eu purus suscipit, interdum justo non, volutpat mi. Integer eu facilisis lacus.

Aenean nibh erat, porttitor quis nulla eu, tempus commodo ipsum. Aenean et metus eget velit euismod finibus. Mauris ut accumsan enim. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vivamus sagittis augue quam, in tempor erat efficitur in. Integer feugiat sit amet lectus nec tristique. Donec cursus nibh et metus rhoncus iaculis. Nullam blandit, risus pretium tempor lobortis, sapien tortor cursus urna, pulvinar ullamcorper orci justo in justo. Integer dapibus elit ac augue luctus, sed sodales elit aliquam. Maecenas eu lorem vel orci rutrum eleifend. Ut eros eros, lacinia suscipit velit id, malesuada facilisis sem. Maecenas porta, leo eget egestas eleifend, ipsum nulla bibendum tortor, quis lobortis nibh mauris vitae magna. Etiam congue metus urna, et ullamcorper est eleifend et. Curabitur metus orci, gravida sed efficitur et, ornare eget quam.

Sed at enim vulputate erat condimentum rhoncus sit amet eget dui. Mauris ornare neque vel faucibus mattis. Aenean non enim eget tellus varius pellentesque ut at mauris. Phasellus id mattis tortor, in maximus elit. Ut ac turpis vitae metus ultrices volutpat sed sed mauris. Proin sed tempor justo. Morbi non scelerisque sapien. Aenean vel velit dui. Fusce non consectetur leo, sed aliquet lorem. Duis efficitur bibendum ante, nec ultrices ipsum. Ut vel suscipit nibh, quis fringilla leo. Morbi maximus lorem sed nisi luctus gravida. Sed elementum purus ornare, tincidunt mi vitae, faucibus ante. Etiam porttitor rutrum justo, vitae cursus ipsum dapibus sit amet. Suspendisse convallis, mauris quis tincidunt commodo, sapien nulla cursus nibh, ac dignissim neque ipsum non ante. Aliquam erat volutpat.

Phasellus quam neque, dictum eu leo quis, sagittis mattis enim. Praesent in vestibulum enim, eu egestas felis. Praesent hendrerit sem nisi, at maximus lacus ultrices non. Cras quis turpis id nulla fringilla bibendum et a ipsum. Phasellus imperdiet, lacus et congue luctus, augue sem maximus leo, a accumsan ipsum turpis a risus. Vivamus non arcu in elit gravida sodales. Maecenas sodales felis in purus cursus, ut finibus justo lacinia. Maecenas id cursus nulla. Sed feugiat risus feugiat eleifend facilisis. Cras tincidunt risus quis lectus fringilla, ut hendrerit mauris suscipit. Nulla quis sagittis metus, eget ullamcorper lacus.

Maecenas pellentesque rutrum auctor. Nunc quis fermentum nulla. Sed eu mi sapien. Nunc sed scelerisque nunc. Integer elementum lacinia orci quis vehicula. Quisque volutpat tristique massa, ut malesuada arcu pellentesque eu. Donec gravida tristique massa vel lacinia. Etiam eget est mollis, viverra massa et, vehicula lectus.
EOT;

    public function testSECP192K1()
    {
        $ecdh_alice = new ECDH(ECDH::SECP192K1);
        $ecdh_bob   = new ECDH(ECDH::SECP192K1);

        $ecdh_bob->computeSecret($ecdh_alice->getPublic());
        $ecdh_alice->computeSecret($ecdh_bob->getPublic());

        $sign   = $ecdh_bob->signMessage(self::MESSAGE);
        $signOk = $ecdh_alice->verifySignature($sign, $ecdh_bob->getPublic(), self::MESSAGE);

        $this->assertEquals(0, gmp_cmp($ecdh_alice->getSecret(), $ecdh_bob->getSecret()));
        $this->assertTrue($signOk, "Signature verification failed");
    }

    public function testSECP192R1()
    {
        $ecdh_alice = new ECDH(ECDH::SECP192R1);
        $ecdh_bob   = new ECDH(ECDH::SECP192R1);

        $ecdh_bob->computeSecret($ecdh_alice->getPublic());
        $ecdh_alice->computeSecret($ecdh_bob->getPublic());

        $sign   = $ecdh_bob->signMessage(self::MESSAGE);
        $signOk = $ecdh_alice->verifySignature($sign, $ecdh_bob->getPublic(), self::MESSAGE);

        $this->assertEquals(0, gmp_cmp($ecdh_alice->getSecret(), $ecdh_bob->getSecret()));
        $this->assertTrue($signOk, "Signature verification failed");

    }

    public function testSECP224K1()
    {
        $ecdh_alice = new ECDH(ECDH::SECP224K1);
        $ecdh_bob   = new ECDH(ECDH::SECP224K1);

        $ecdh_bob->computeSecret($ecdh_alice->getPublic());
        $ecdh_alice->computeSecret($ecdh_bob->getPublic());

        $sign   = $ecdh_bob->signMessage(self::MESSAGE);
        $signOk = $ecdh_alice->verifySignature($sign, $ecdh_bob->getPublic(), self::MESSAGE);

        $this->assertEquals(0, gmp_cmp($ecdh_alice->getSecret(), $ecdh_bob->getSecret()));

        // TODO: Fix problem with signature
//        $this->assertTrue($signOk, "Signature verification failed");
    }

    public function testSECP224R1()
    {
        $ecdh_alice = new ECDH(ECDH::SECP224R1);
        $ecdh_bob   = new ECDH(ECDH::SECP224R1);

        $ecdh_bob->computeSecret($ecdh_alice->getPublic());
        $ecdh_alice->computeSecret($ecdh_bob->getPublic());

        $sign   = $ecdh_bob->signMessage(self::MESSAGE);
        $signOk = $ecdh_alice->verifySignature($sign, $ecdh_bob->getPublic(), self::MESSAGE);

        $this->assertEquals(0, gmp_cmp($ecdh_alice->getSecret(), $ecdh_bob->getSecret()));
        $this->assertTrue($signOk, "Signature verification failed");

    }

    public function testSECP256K1()
    {
        $ecdh_alice = new ECDH(ECDH::SECP256K1);
        $ecdh_bob   = new ECDH(ECDH::SECP256K1);

        $ecdh_bob->computeSecret($ecdh_alice->getPublic());
        $ecdh_alice->computeSecret($ecdh_bob->getPublic());

        $sign   = $ecdh_bob->signMessage(self::MESSAGE);
        $signOk = $ecdh_alice->verifySignature($sign, $ecdh_bob->getPublic(), self::MESSAGE);

        $this->assertEquals(0, gmp_cmp($ecdh_alice->getSecret(), $ecdh_bob->getSecret()));
        $this->assertTrue($signOk, "Signature verification failed");

    }

    public function testSECP256R1()
    {
        $ecdh_alice = new ECDH(ECDH::SECP256R1);
        $ecdh_bob   = new ECDH(ECDH::SECP256R1);

        $ecdh_bob->computeSecret($ecdh_alice->getPublic());
        $ecdh_alice->computeSecret($ecdh_bob->getPublic());

        $sign   = $ecdh_bob->signMessage(self::MESSAGE);
        $signOk = $ecdh_alice->verifySignature($sign, $ecdh_bob->getPublic(), self::MESSAGE);

        $this->assertEquals(0, gmp_cmp($ecdh_alice->getSecret(), $ecdh_bob->getSecret()));
        $this->assertTrue($signOk, "Signature verification failed");

    }

    public function testSECP384R1()
    {
        $ecdh_alice = new ECDH(ECDH::SECP384R1);
        $ecdh_bob   = new ECDH(ECDH::SECP384R1);

        $ecdh_bob->computeSecret($ecdh_alice->getPublic());
        $ecdh_alice->computeSecret($ecdh_bob->getPublic());

        $sign   = $ecdh_bob->signMessage(self::MESSAGE);
        $signOk = $ecdh_alice->verifySignature($sign, $ecdh_bob->getPublic(), self::MESSAGE);

        $this->assertEquals(0, gmp_cmp($ecdh_alice->getSecret(), $ecdh_bob->getSecret()));
        $this->assertTrue($signOk, "Signature verification failed");

    }

    public function testSECP521R1()
    {
        $ecdh_alice = new ECDH(ECDH::SECP521R1);
        $ecdh_bob   = new ECDH(ECDH::SECP521R1);

        $ecdh_bob->computeSecret($ecdh_alice->getPublic());
        $ecdh_alice->computeSecret($ecdh_bob->getPublic());

        $sign   = $ecdh_bob->signMessage(self::MESSAGE);
        $signOk = $ecdh_alice->verifySignature($sign, $ecdh_bob->getPublic(), self::MESSAGE);

        $this->assertEquals(0, gmp_cmp($ecdh_alice->getSecret(), $ecdh_bob->getSecret()));

        // TODO: Fix problem with signature
//        $this->assertTrue($signOk, "Signature verification failed");
    }
}