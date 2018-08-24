<?php

namespace Omnipay\Magnius\Message;

/**
 * Magnius Fetch Issuers Request
 *
 * @method \Omnipay\Magnius\Message\FetchIssuersResponse send()
 */
class FetchIssuersRequest extends AbstractRequest
{
    protected function getRequestMethod()
    {
        return 'GET';
    }
    
    public function getData()
    {
        $this->validate('apiKey');
    }

    protected function getRequestUrl()
    {
        return 'transaction/ideal/issuers';
    }

    protected function createResponse($data)
    {
        return $this->response = new FetchIssuersResponse($this, $data);
    }
}
