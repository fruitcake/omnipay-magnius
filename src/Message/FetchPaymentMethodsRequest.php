<?php

namespace Omnipay\Magnius\Message;

/**
 * Magnius Fetch PaymentMethods Request
 *
 * @method \Omnipay\Magnius\Message\FetchPaymentMethodsResponse send()
 */
class FetchPaymentMethodsRequest extends AbstractRequest
{
    /**
     * @return null
     */
    public function getData()
    {
        $this->validate('apiKey');
    }

    public function sendData($data)
    {
        return $this->response = new FetchPaymentMethodsResponse($this, null);
    }

    protected function getRequestUrl()
    {
        return null;
    }
}
