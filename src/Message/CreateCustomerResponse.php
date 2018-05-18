<?php

namespace Omnipay\Magnius\Message;

class CreateCustomerResponse extends Response
{
    /**
     * @return string
     */
    public function getCustomerId()
    {
        if (isset($this->data['id'])) {
            return $this->data['id'];
        }
    }
}
