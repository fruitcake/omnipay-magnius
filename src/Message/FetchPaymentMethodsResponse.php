<?php

namespace Omnipay\Magnius\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\FetchPaymentMethodsResponseInterface;
use Omnipay\Common\PaymentMethod;

class FetchPaymentMethodsResponse extends AbstractResponse implements FetchPaymentMethodsResponseInterface
{
    protected $paymentMethods = [
//        'capayable' => 'Capayable',
        'ideal' => 'iDEAL',
//        'inthreeinstallments' => 'In Three Installments',
        'paypal' => 'PayPal',
//        'card' => 'Card',
//        'sepa' => 'Sepa',
    ];

    /**
     * Return available paymentmethods as an associative array.
     *
     * @return \Omnipay\Common\PaymentMethod[]
     */
    public function getPaymentMethods()
    {
        $paymentMethods = array();
        foreach ($this->paymentMethods as $id => $name) {
            $paymentMethods[] = new PaymentMethod($id, $name);
        }

        return $paymentMethods;
    }

    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return true;
    }
}
