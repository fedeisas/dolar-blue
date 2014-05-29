Dolar Blue PHP
==============

[![Travis Badge](https://secure.travis-ci.org/fedeisas/dolar-blue.png)](http://travis-ci.org/fedeisas/dolar-blue)
[![Coverage Status](https://coveralls.io/repos/fedeisas/dolar-blue/badge.png)](https://coveralls.io/r/fedeisas/dolar-blue)
[![Latest Stable Version](https://poser.pugx.org/fedeisas/dolar-blue/v/stable.png)](https://packagist.org/packages/fedeisas/dolar-blue)
[![Latest Unstable Version](https://poser.pugx.org/fedeisas/dolar-blue/v/unstable.png)](https://packagist.org/packages/fedeisas/dolar-blue)
[![Total Downloads](https://poser.pugx.org/fedeisas/dolar-blue/downloads.png)](https://packagist.org/packages/fedeisas/dolar-blue)
[![License](https://poser.pugx.org/fedeisas/dolar-blue/license.png)](https://packagist.org/packages/fedeisas/dolar-blue)

## Why?
Because Argentina has a black market for currency exchange. And this makes it easy to retrieve the current USD conversion rate from different sources. And also because I needed something small to talk about Package Development and testing on [this meetup](http://www.meetup.com/Laravel-Buenos-Aires/events/174574162/).

## Requirements
- PHP >= 5.4

## Installation
Begin by installing this package through Composer. Edit your project's `composer.json` file to require `fedeisas/dolar-blue.

```json
{
  "require": {
        ...
        "fedeisas/dolar-blue": "1.*"
        ...
    },
    "minimum-stability" : "dev"
}
```

Next, update Composer from the Terminal:
```bash
$ composer update
```

Once this operation completes, the final step is to add the service provider. Open `app/config/app.php`, and add a new item to the providers array.
```php
'providers' => array(
    ...
    'Fedeisas\LaravelDolarBlue\LaravelDolarBlueServiceProvider',
)
```

Optionally you can also add the Facade to the aliases array on `app/config/app.php`:
```php
'aliases' => array(
    ...
    'DolarBlue' => 'Fedeisas\LaravelDolarBlue\Facade\LaravelDolarBlue',
)
```

## Providers
+ [LaNacion](http://www.lanacion.com.ar/)
+ [DolarBlue](http://dolarblue.net/)
+ [BlueLytics](http://bluelytics.com.ar/)
+ [PrecioDolarBlue](http://www.preciodolarblue.com.ar/)

## Usage

```php
use Fedeisas\DolarBlue\DolarBlue;
use GuzzleHttp\Client;

$service = new DolarBlue(new Client);
$result = $service->get('DolarBlue'); // or $service->DolarBlue();
// returns
// array(
//   'buy' => '10.15',
//   'sell' => '10.55',
//   'timestamp' => 1399080004
// )
```

Or you can use magic methods:
```php
$result = $service->LaNacion();
$result = $service->DolarBlue();
$result = $service->BlueLytics();
```

## Contributing
```bash
$ composer install --dev
$ ./vendor/bin/phpunit
```
In addition to a full test suite, there is Travis integration.

## Found a bug?
Please, let me know! Send a pull request or a patch. Questions? Ask! I will respond to all filed issues.

## Inspiration
I needed an idea for a small library, and I borrowed it from a friend who has done something similar for NodeJS. You should check it out: https://github.com/matiu/dolar-blue

## License
This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)