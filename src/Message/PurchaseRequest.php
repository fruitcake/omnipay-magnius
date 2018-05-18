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

        $paymentMethod = strtolower($this->getPaymentMethod());

        $data = $this->getBaseData();

        if ($paymentMethod === 'ideal') {
            $this->validate('issuer');
            $data['details']['issuer'] = $this->getIssuer();
        }

        if ($paymentMethod === 'sepa') {
            $this->validate('customerId');
            $data['customer'] = $this->getCustomerId();
        }

        $data['amount'] = $this->getAmountInteger();
        $data['payment_product'] = $paymentMethod;

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
