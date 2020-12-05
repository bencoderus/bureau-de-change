<?php

require 'vendor/autoload.php';

use Bencoderus\BureauDeChange\Converter;

$convert = new Converter();
$amount = $convert->currency('BNB', 'USD')->convert(1);

var_dump($amount);
