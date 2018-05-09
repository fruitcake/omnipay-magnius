<?php

namespace Omnipay\Magnius\Message;

class CreateCustomerResponse extends Response
{
    /**
     * @return string
     */
    public function getCustomerReference()
    {
        if (isset($this->data['id'])) {
            return $this->data['id'];
        }
    }
}
