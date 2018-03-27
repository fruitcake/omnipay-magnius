<?php
namespace Omnipay\Magnius\Message;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 * Authorize Request
 *
 * @method PurchaseResponse send()
 */
class CompletePurchaseRequest extends AbstractRequest
{
    public function getData()
    {
        return null;
    }

    protected function getRequestMethod()
    {
        return 'GET';
    }

    protected function getRequestUrl()
    {
        $transactionReference = $this->getTransactionReference();

        if (empty($transactionReference)) {
            $transactionReference = $this->httpRequest->query->get('transaction_id');
        }

        if (empty($transactionReference)) {
            throw new InvalidRequestException("The transactionReference parameter is required");
        }

        return "transaction/{$transactionReference}";
    }

    protected function createResponse($data)
    {
        return $this->response = new CompletePurchaseResponse($this, $data);
    }
}
