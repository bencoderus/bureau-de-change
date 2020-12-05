<?php

require 'vendor/autoload.php';

use Bencoderus\CurrencyConverter\Converter;

$convert = new Converter();
$amount = $convert->currency('USD', 'XRP')->convert(100);

var_dump($amount);