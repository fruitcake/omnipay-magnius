<?php
namespace Omnipay\Magnius\Message;

/**
 * Authorize Request
 *
 * @method PurchaseResponse send()
 */
class PurchaseRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('amount', 'paymentMethod');

        $data = $this->getBaseData();

        $data['details']['issuer'] = 'ABNANL2A';
        $data['amount'] = $this->getAmountInteger();
        $data['payment_product'] = $this->getPaymentMethod();

        return $data;
    }

    protected function getRequestUrl()
    {
        return 'transaction/start';
    }

    protected function createResponse($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }
}
