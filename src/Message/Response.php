<?php

namespace Omnipay\Magnius\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

/**
 * Response
 */
class Response extends AbstractResponse
{

    public function isSuccessful()
    {
        return  ! isset($this->data['code']) && ! $this->isRedirect();
    }

    public function getTransactionReference()
    {
        if (isset($this->data['id'])) {
            return $this->data['id'];
        }
    }

    public function getTransactionId()
    {
        if (isset($this->data['merchant_reference'])) {
            return $this->data['merchant_reference'];
        }
    }

    /**
     * Does the response require a redirect?
     *
     * @return boolean
     */
    public function isRedirect()
    {
        return false;
    }

    /**
     * Get the response data.
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Response Message
     *
     * @return null|string A response message from the payment gateway
     */
    public function getMessage()
    {
        if (isset($this->data['message'])) {
            return $this->data['message'];
        }
    }

    /**
     * Response code
     *
     * @return null|string A response code from the payment gateway
     */
    public function getCode()
    {
        if (isset($this->data['code'])) {
            return $this->data['code'];
        }
    }

    /**
     * Details
     *
     * @return null|array The details from an error
     */
    public function getDetails()
    {
        if (isset($this->data['details'])) {
            return $this->data['details'];
        }
    }
}
