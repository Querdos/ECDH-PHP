<?php

function __autoload($class)
{
    require_once 'lib/DomainParameters.php';
    require_once 'lib/ECDH.php';
    require_once 'lib/ECDHSignature.php';

    require_once 'Util/MathUtil.php';
    require_once 'Util/SecpUtil.php';
}
