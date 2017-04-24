<?php
require "autoloader.php";
use Querdos\Lib\ECDH;

$ecdh_alice = new ECDH(ECDH::SECP521R1);
$ecdh_bob   = new ECDH(ECDH::SECP521R1);

$ecdh_alice->computeSecret($ecdh_bob->getPublic());
$ecdh_bob->computeSecret($ecdh_alice->getPublic());

if (0 == gmp_cmp($ecdh_alice->getSecret()[0], $ecdh_bob->getSecret()[0])) {
    if (0 == gmp_cmp($ecdh_alice->getSecret()[1], $ecdh_bob->getSecret()[1])) {
        echo "Alice and bob share the same secret" . PHP_EOL;
        exit;
    }
}

echo "Alice and bob don't share the same secret" . PHP_EOL;
