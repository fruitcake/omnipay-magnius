<?php

namespace Omnipay\Magnius\Message;

use Omnipay\Common\Issuer;
use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\FetchIssuersResponseInterface;

class FetchIssuersResponse extends AbstractResponse implements FetchIssuersResponseInterface
{
    protected $issuers = [
        'ABNANL2A' => 'ABN Amro',
        'ASNBNL21' => 'ASN Bank',
        'BUNQNL2A' => 'Bunq',
        'FVLBNL22' => 'Van Lanschot Bankiers',
        'INGBNL2A' => 'ING',
        'KNABNL2H' => 'Knab',
        'RABONL2U' => 'Rabobank',
        'RBRBNL21' => 'RegioBank',
        'SNSBNL2A' => 'SNS Bank',
        'TRIONL2U' => 'Triodos Bank'
    ];

    /**
     * Return available issuers as an associative array.
     *
     * @return \Omnipay\Common\Issuer[]
     */
    public function getIssuers()
    {
        $issuers = array();
        foreach ($this->issuers as $id => $name) {
            $issuers[] = new Issuer($id, $name, 'ideal');
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
        return true;
    }
}
