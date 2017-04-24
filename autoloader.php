<?php

function __autoload($class)
{
    $parts = explode('\\', $class);

    // requiring util classes
    require 'lib/' . end($parts) . '.php';
}
