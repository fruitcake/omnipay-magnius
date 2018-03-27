<?php

namespace Omnipay\Magnius\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\RequestInterface;

/**
 * Response
 */
class CompletePurchaseResponse extends Response
{
    public function isSuccessful()
    {
        return parent::isSuccessful() && $this->isPaid();
    }

    protected function isPaid()
    {
        return isset($this->data['status']) && $this->data['status'] == 'SETTLEMENT_COMPLETED';
    }
}
