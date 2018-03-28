<?php

namespace Omnipay\Magnius\Message;

/**
 * Magnius Fetch Issuers Request
 *
 * @method \Omnipay\Magnius\Message\FetchIssuersResponse send()
 */
class FetchIssuersRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('apiKey');
    }

    public function sendData($data)
    {
        return $this->response = new FetchIssuersResponse($this, null);
    }

    protected function getRequestUrl()
    {
        return null;
    }
}
