<?php

namespace Omnipay\Magnius;

use Omnipay\Common\AbstractGateway;
use Omnipay\Magnius\Message\CompletePurchaseRequest;
use Omnipay\Magnius\Message\PurchaseRequest;

/**
 * Magnius Gateway
 *
 * @link https://payground-api.magnius.com/
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Magnius';
    }

    public function getDefaultParameters()
    {
        return array(
            'accountId' => null,
            'apiKey' => null,
            'testMode' => false,
        );
    }

    public function getAccountId()
    {
        return $this->getParameter('accountId');
    }

    public function setAccountId($value)
    {
        return $this->setParameter('accountId', $value);
    }

    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    /**
     * @return PurchaseRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest(PurchaseRequest::class, $parameters);
    }

    /**
     * @return CompletePurchaseRequest
     */
    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest(CompletePurchaseRequest::class, $parameters);
    }
}
