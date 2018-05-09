<?php

namespace Omnipay\Magnius;

use Omnipay\Common\AbstractGateway;
use Omnipay\Magnius\Message\CompletePurchaseRequest;
use Omnipay\Magnius\Message\CreateCustomerRequest;
use Omnipay\Magnius\Message\FetchIssuersRequest;
use Omnipay\Magnius\Message\FetchPaymentMethodsRequest;
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
            'organisationId' => null,
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

    /**
     * @param  array $parameters
     * @return FetchIssuersRequest
     */
    public function fetchIssuers(array $parameters = array())
    {
        return $this->createRequest(FetchIssuersRequest::class, $parameters);
    }

    /**
     * @param  array $parameters
     * @return FetchPaymentMethodsRequest
     */
    public function fetchPaymentMethods(array $parameters = array())
    {
        return $this->createRequest(FetchPaymentMethodsRequest::class, $parameters);
    }

    /**
     * @param  array $parameters
     * @return CreateCustomerRequest
     */
    public function createCustomer(array $parameters = array())
    {
        return $this->createRequest(CreateCustomerRequest::class, $parameters);
    }
}
