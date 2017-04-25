<?php
require "autoloader.php";

use Querdos\lib\ECDHCurve25519;
use Querdos\lib\ECDHCurve448;
use Querdos\Lib\ECDHSecp;

function compare_secret($v1, $v2) {
    return 0 == gmp_cmp($v1->getSecret(), $v2->getSecret());
}

// Alice want to send bob a message
$message = <<<EOT
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam interdum massa nec libero semper, sed consequat ipsum dictum. Nulla sit amet enim eleifend, iaculis dui tristique, malesuada est. Vestibulum non neque in leo sagittis aliquet. Sed ultrices nunc a quam faucibus vestibulum. Maecenas nec elit at enim rutrum egestas non ut tortor. Ut tincidunt volutpat elit, ut consequat libero tincidunt pretium. Cras feugiat facilisis dolor eget dapibus. Suspendisse eget ligula lorem. Vivamus molestie massa sed dictum pulvinar.

Integer vitae cursus metus, nec iaculis ante. Nam finibus nulla id magna pharetra, vel eleifend ligula semper. Aliquam a semper elit, ut rutrum turpis. Fusce suscipit orci non lectus rutrum posuere. Aenean ut lectus nec ipsum mollis malesuada vitae in ex. Sed bibendum est sed neque fermentum, sit amet consectetur quam ultricies. Aliquam et molestie nunc. Integer elementum mollis facilisis. Ut feugiat placerat vulputate. Nam ultricies feugiat nisi. Quisque placerat iaculis enim eget efficitur. Praesent eget condimentum ante. Duis eget ante velit.

In hac habitasse platea dictumst. Aenean eu lacinia felis, non placerat eros. Proin fringilla tortor in ipsum tempus posuere. Pellentesque consequat mattis arcu sed tincidunt. Sed et leo pellentesque, semper diam eget, vehicula quam. Duis viverra turpis mi, a porta quam euismod a. Nullam nulla neque, finibus vitae suscipit vehicula, ullamcorper a tortor. Morbi ullamcorper diam lectus, id consequat velit hendrerit at. Aenean vulputate, urna sit amet ornare placerat, ipsum nibh pulvinar purus, congue accumsan nisi arcu eget turpis. In leo tellus, gravida in ligula ut, efficitur tristique tellus. Donec tempus tempus augue, in lobortis nunc. Nulla vulputate tortor sed turpis mattis pharetra. Ut vestibulum cursus neque. Nam pulvinar elit eu sodales vulputate. Cras et sapien et felis lobortis tempus. Integer in leo sapien.

Nulla rutrum elementum pretium. Aenean sollicitudin neque dolor, eget pretium turpis placerat at. Ut ac lorem ipsum. Mauris risus quam, feugiat a libero et, mollis auctor dui. Donec condimentum porta ultricies. Phasellus aliquam elit vehicula, volutpat sapien lacinia, iaculis dolor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer volutpat nisi sed lectus ullamcorper, id viverra lacus molestie. Duis at lacus turpis. Donec vehicula elementum lectus eu vestibulum. Cras elementum sed sapien nec sollicitudin. Nunc nec tortor a diam euismod malesuada eget sed nibh. Suspendisse porta mattis augue.

Proin aliquet in justo ac sodales. Aenean at diam ultrices, gravida libero in, tempus est. Donec sed sagittis diam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla mollis tincidunt purus ullamcorper pharetra. Suspendisse sollicitudin, nibh ac feugiat rutrum, purus arcu imperdiet dolor, ornare tristique massa urna sit amet nunc. Donec congue rutrum maximus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Morbi finibus sollicitudin elit, eu tincidunt quam viverra vel. Maecenas dictum nisl ut luctus molestie. Curabitur rutrum lacus urna, at luctus nulla mattis et.
EOT;

// creating key pair with curve25519
$ecdhCurve25519_A = new ECDHCurve25519();
$ecdhCurve25519_B = new ECDHCurve25519();

// creating key pair with curve448
$ecdhCurve448_A = new ECDHCurve448();
$ecdhCurve448_B = new ECDHCurve448();

// creating key pair with SECP192K1
$ecdhSECP192K1_A = new ECDHSecp();
$ecdhSECP192K1_B = new ECDHSecp();

// creating key pair with SECP192R1
$ecdhSECP192R1_A = new ECDHSecp(ECDHSecp::SECP192R1);
$ecdhSECP192R1_B = new ECDHSecp(ECDHSecp::SECP192R1);

// creating key pair with SECP224R1
$ecdhSECP224R1_A = new ECDHSecp(ECDHSecp::SECP224R1);
$ecdhSECP224R1_B = new ECDHSecp(ECDHSecp::SECP224R1);

// creating key pair with SECP256K1
$ecdhSECP256K1_A = new ECDHSecp(ECDHSecp::SECP256K1);
$ecdhSECP256K1_B = new ECDHSecp(ECDHSecp::SECP256K1);

// creating key pair with SECP256R1
$ecdhSECP256R1_A = new ECDHSecp(ECDHSecp::SECP256R1);
$ecdhSECP256R1_B = new ECDHSecp(ECDHSecp::SECP256R1);

// creating key pair with SECP384R1
$ecdhSECP384R1_A = new ECDHSecp(ECDHSecp::SECP384R1);
$ecdhSECP384R1_B = new ECDHSecp(ECDHSecp::SECP384R1);

// computing secrets
$ecdhCurve448_A->computeSecret($ecdhCurve448_B->getPublic());
$ecdhCurve448_B->computeSecret($ecdhCurve448_A->getPublic());

$ecdhCurve25519_A->computeSecret($ecdhCurve25519_B->getPublic());
$ecdhCurve25519_B->computeSecret($ecdhCurve25519_A->getPublic());

$ecdhSECP192K1_A->computeSecret($ecdhSECP192K1_B->getPublic());
$ecdhSECP192K1_B->computeSecret($ecdhSECP192K1_A->getPublic());

$ecdhSECP192R1_A->computeSecret($ecdhSECP192R1_B->getPublic());
$ecdhSECP192R1_B->computeSecret($ecdhSECP192R1_A->getPublic());

$ecdhSECP224R1_A->computeSecret($ecdhSECP224R1_B->getPublic());
$ecdhSECP224R1_B->computeSecret($ecdhSECP224R1_A->getPublic());

$ecdhSECP256K1_A->computeSecret($ecdhSECP256K1_B->getPublic());
$ecdhSECP256K1_B->computeSecret($ecdhSECP256K1_A->getPublic());

$ecdhSECP256R1_A->computeSecret($ecdhSECP256R1_B->getPublic());
$ecdhSECP256R1_B->computeSecret($ecdhSECP256R1_A->getPublic());

$ecdhSECP384R1_A->computeSecret($ecdhSECP384R1_B->getPublic());
$ecdhSECP384R1_B->computeSecret($ecdhSECP384R1_A->getPublic());

echo "SECP 192 K1 Secrets validation: ";
compare_secret($ecdhSECP192K1_A, $ecdhSECP192K1_B) ? $valid = "OK" : $valid = "NOK";
echo $valid . PHP_EOL;
echo "SECP 192 K1 Signing: ";
$sign   = $ecdhSECP192K1_A->signMessage($message);
$signOk = $ecdhSECP192K1_B->verifySignature($sign, $ecdhSECP192K1_A->getPublic(), $message);
$signOk ? $valid = "OK" : $valid = "NOK";
echo $valid . PHP_EOL . PHP_EOL;

echo "SECP 192 R1 Secrets validation: ";
compare_secret($ecdhSECP192R1_A, $ecdhSECP192R1_B) ? $valid = "OK" : $valid = "NOK";
echo $valid . PHP_EOL;
echo "SECP 192 R1 Signing: ";
$sign   = $ecdhSECP192R1_A->signMessage($message);
$signOk = $ecdhSECP192R1_B->verifySignature($sign, $ecdhSECP192R1_A->getPublic(), $message);
$signOk ? $valid = "OK" : $valid = "NOK";
echo $valid . PHP_EOL . PHP_EOL;

echo "SECP 224 R1 Secrets validation: ";
compare_secret($ecdhSECP224R1_A, $ecdhSECP224R1_B) ? $valid = "OK" : $valid = "NOK";
echo $valid . PHP_EOL;

echo "SECP 256 K1 Secrets validation: ";
compare_secret($ecdhSECP256K1_A, $ecdhSECP256K1_B) ? $valid = "OK" : $valid = "NOK";
echo $valid . PHP_EOL;

echo "SECP 256 R1 Secrets validation: ";
compare_secret($ecdhSECP256R1_A, $ecdhSECP256R1_B) ? $valid = "OK" : $valid = "NOK";
echo $valid . PHP_EOL;

echo "SECP 384 R1 Secrets validation: ";
compare_secret($ecdhSECP384R1_A, $ecdhSECP384R1_B) ? $valid = "OK" : $valid = "NOK";
echo $valid . PHP_EOL;

echo "\nCurve25519 Secrets validation: ";
compare_secret($ecdhCurve25519_A, $ecdhCurve25519_B) ? $valid = "OK" : $valid = "NOK";
echo $valid . PHP_EOL;

echo "Curve448   Secrets validation: ";
compare_secret($ecdhCurve448_A, $ecdhCurve448_B) ? $valid = "OK" : $valid = "NOK";
echo $valid . PHP_EOL;


