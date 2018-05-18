<?php

namespace Omnipay\Magnius\Message;

use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

/**
 * Abstract Request
 *
 */
abstract class AbstractRequest extends BaseAbstractRequest
{
    protected $liveEndpoint = 'https://api.magnius.com/v1/';
    protected $testEndpoint = 'https://payground-api.magnius.com/v1/';

    public function getAccountId()
    {
        return $this->getParameter('accountId');
    }

    public function setAccountId($value)
    {
        return $this->setParameter('accountId', $value);
    }

    public function getOrganisationId()
    {
        return $this->getParameter('organisationId');
    }

    public function setOrganisationId($value)
    {
        return $this->setParameter('organisationId', $value);
    }

    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }


    public function getCustomerId()
    {
        return $this->getParameter('customerId');
    }

    public function setCustomerId($value)
    {
        return $this->setParameter('customerId', $value);
    }

    public function sendData($data)
    {
        $this->validate('apiKey');

        $url = $this->getEndpoint() . $this->getRequestUrl();

        $response = $this->httpClient->request($this->getRequestMethod(), $url, [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'apiKey' => $this->getApiKey(),
        ], json_encode($data));

        $data = json_decode($response->getBody(), true);

        return $this->createResponse($data);
    }

    protected function getBaseData()
    {
        $this->validate('accountId');

        return [
            'account' => $this->getAccountId(),
            'customer_ip' => $this->getClientIp() ?: $this->httpRequest->getClientIp(),
            'merchant_reference' => $this->getTransactionId(),
            'dynamic_descriptor' => $this->getDescription(),
            'user_agent' => 'php/omnipay',
            'webhook_transaction_update' => $this->getNotifyUrl(),
            'details' => [
                'redirect_url' => $this->getReturnUrl(),
            ]
        ];
    }

    protected function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    protected function getRequestMethod()
    {
        return 'POST';
    }

    abstract protected function getRequestUrl();

    protected function createResponse($data)
    {
        return $this->response = new Response($this, $data);
    }
}
