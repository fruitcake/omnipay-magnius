<?php

namespace Omnipay\Magnius\Message;

use Omnipay\Common\Issuer;
use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\FetchIssuersResponseInterface;

class FetchIssuersResponse extends AbstractResponse implements FetchIssuersResponseInterface
{

    /**
     * Return available issuers as an associative array.
     *
     * @return \Omnipay\Common\Issuer[]
     */
    public function getIssuers()
    {
        $issuers = array();
        foreach ($this->data as $issuer) {
            $issuers[] = new Issuer($issuer['issuer'], $issuer['name'], 'ideal');
        }

        return $issuers;
    }

    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return $this->data && count($this->data) > 0;
    }
}
