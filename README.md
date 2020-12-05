# Bureau De Change

A lightweight PHP library for currency conversion with over 40 currencies supports (including cryptocurrencies).

## Installation

Requires PHP >= 7.0 and [composer](https://getcomposer.org/) is required to install package.

```bash
composer require bencoderus/bureau-de-change
```

## Usage
Convert 1 BTC to USD
```php
use Bencoderus\BureauDeChange\Converter;
$convert = new Converter();
return $convert->currency('BTC', 'USD')->convert(1);
```
Convert 100 GBP to USD
```php
use Bencoderus\BureauDeChange\Converter;

return (new Converter())->currency('GBP', 'USD')->convert(100);
```

## Supported Currencies
CAD, HKD, ISK, PHP, DKK, HUF, CZK, GBP, RON, SEK, IDR, INR, BRL, RUB, HRK, JPY, THB, CHF, EUR, MYR, BGN, TRY, CNY, NOK, NZD, ZAR, USD, MXN, SGD, AUD, ILS, KRW, PLN, BTC, ETH, LTC, BCH, BNB, EOS, XRP, BNB, XLM, DOT, LINK, YFI

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## Author
[Benjamin Iduwe](https://biduwe.com/)


## License
[MIT](https://choosealicense.com/licenses/mit/)
