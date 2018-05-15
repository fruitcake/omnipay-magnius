# Omnipay: Magnius

**Magnius gateway for the Omnipay PHP payment processing library**

[![Latest Version on Packagist](https://img.shields.io/packagist/v/fruitcake/omnipay-magnius.svg?style=flat-square)](https://packagist.org/packages/fruitcake/omnipay-magnius)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/fruitcake/omnipay-magnius/master.svg?style=flat-square)](https://travis-ci.org/fruitcake/omnipay-magnius)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/fruitcake/omnipay-magnius.svg?style=flat-square)](https://scrutinizer-ci.com/g/fruitcake/omnipay-magnius/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/fruitcake/omnipay-magnius.svg?style=flat-square)](https://scrutinizer-ci.com/g/fruitcake/omnipay-magnius)
[![Total Downloads](https://img.shields.io/packagist/dt/fruitcake/omnipay-magnius.svg?style=flat-square)](https://packagist.org/packages/fruitcake/omnipay-magnius)


[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 7.1+. This package implements Magnius support for Omnipay.

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what
PSRs you support to avoid any confusion with users and contributors.

## Install

Via Composer

``` bash
$ composer require league/omnipay fruitcake/omnipay-magnius
```

## Usage

The following gateways are provided by this package:

 * Magnius

The following paymentMethods are implemented:

 * ideal
 * paypal
 
## Example

```php
 $gateway = \Omnipay\Omnipay::create('Magnius');
    $gateway->initialize(array(
        'accountId' => '',
        'apiKey' => '',
        'testMode' => true,
    ));

    // Start the purchase
    if(!isset($_GET['transaction_id'])){
        $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $response = $gateway->purchase(array(
            'amount' => "6.84",
            'description' => "Testorder #1234",
            'issuer' => 'ABNANL2A',                  // Get the id from the issuers list
            'paymentMethod' => 'ideal',             // For 'ideal', the Issuer is required
            'transactionId' => 1234,
            'returnUrl' => $url,
            'notifyUrl' => $url,
        ))->send();

        if ($response->isRedirect()) {
            // redirect to offsite payment gateway
            $response->redirect();
        } elseif ($response->isPending()) {
            // Process started (for example, 'overboeking')
            return "Pending, Reference: ". $response->getTransactionReference();
        } else {
            // payment failed: display message to customer
            return "Error " .$response->getCode() . ': ' . $response->getMessage() . 
            ' Details: '. print_r($response->getDetails(), true);
        }
    }else{
        // Check the status
        $response = $gateway->completePurchase()->send();
        if($response->isSuccessful()){
            $reference = $response->getTransactionReference();  // TODO; Check the reference/id with your database
            return "Transaction '" . $response->getTransactionId() . "' succeeded!";
        }else{
            return "Error " .$response->getCode() . ': ' . $response->getMessage();
        }
    }
```

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay) repository.

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release announcements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/fruitcake/omnipay-magnius/issues),
or better yet, fork the library and submit a pull request.

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email barry@fruitcake.nl instead of using the issue tracker.

## Credits

- [Barry vd. Heuvel](https://github.com/barryvdh)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
