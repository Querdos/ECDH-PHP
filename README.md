# ECDH-PHP
An Elliptic Curve Diffie Hellman Implementation in PHP.  

Domain parameters used are from the [Recommended Elliptic Curve Domain Parameters](http://www.secg.org/sec2-v2.pdf)

# Available constants
Here are available standard for the ECDH protocol:
```php
    ECDH::SECP192K1 // Recommended Parameters SECP192K1 (192-bit)
    ECDH::SECP192R1 // Recommended Parameters SECP192R1 (192-bit)
    ECDH::SECP224K1 // Recommended Parameters SECP224K1 (224-bit)
    ECDH::SECP224R1 // Recommended Parameters SECP224R1 (224-bit)
    ECDH::SECP256K1 // Recommended Parameters SECP256K1 (256-bit)
    ECDH::SECP256R1 // Recommended Parameters SECP256R1 (256-bit)
    ECDH::SECP384R1 // Recommended Parameters SECP384R1 (384-bit)
    ECDH::SECP521R1 // Recommended Parameters SECP521R1 (521-bit)
```

# Example
```php
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
```
