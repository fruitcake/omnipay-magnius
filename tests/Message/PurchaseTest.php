<?php

namespace Omnipay\Magnius\Tests;

use Omnipay\Common\CreditCard;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Magnius\Message\PurchaseRequest;
use Omnipay\Magnius\Message\PurchaseResponse;
use Omnipay\Magnius\Message\Response;
use Omnipay\Tests\TestCase;

class PurchaseTest extends TestCase
{
    /**
     * @var PurchaseRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize(
            array(
                'accountId' => 'foo123',
                'apiKey' => 'bar456',
                'testMode' => true,
                'amount' => '10.00',
                'returnUrl' => 'https://example.com/return',
                'notifyUrl' => 'https://example.com/notify',
                'transactionId' => uniqid(),
                'clientIp' => '127.0.0.1',
                'description' => 'orderdesc01',
                'paymentMethod' => 'ideal',
                'issuer' => 'ABNANL2A',
            )
        );
    }

    public function testGetData()
    {
        $this->assertTrue($this->request->getTestMode());
        $this->assertSame('bar456', $this->request->getApiKey());

        $data = $this->request->getData();

        $this->assertSame('foo123', $data['account']);
        $this->assertSame(1000, $data['amount']);
        $this->assertSame('ideal', $data['payment_product']);
    }

    public function testGetDataIdealWithoutIssuer()
    {
        $this->expectException(InvalidRequestException::class);
        $this->expectExceptionMessage('The issuer parameter is required');

        $data = $this->request
            ->setIssuer(null)
            ->getData();
    }

    public function testGetDataSepaWithoutCustomer()
    {
        $this->expectException(InvalidRequestException::class);
        $this->expectExceptionMessage('The customerId parameter is required');

        $data = $this->request
            ->setPaymentMethod('sepa')
            ->getData();
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('PurchaseSuccess.txt');
        $response = $this->request->send();

        $this->assertInstanceOf(PurchaseResponse::class, $response);
        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertEquals('123abc', $response->getTransactionReference());
        $this->assertEquals('5ab365dfdb1dd', $response->getTransactionId());
    }
}
