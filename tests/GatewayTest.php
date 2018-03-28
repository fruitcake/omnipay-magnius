<?php

namespace Omnipay\Magnius\Tests;


use Omnipay\Magnius\Gateway;
use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    /** @var Gateway */
    protected $gateway;

    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->initialize([
            'accountId' => 'foo123',
            'apiKey' => 'bar456',
            'testMode' => true,
        ]);
    }

    public function testGetData()
    {
        $this->assertSame('foo123', $this->gateway->getAccountId());
        $this->assertSame('bar456', $this->gateway->getApiKey());
        $this->assertTrue($this->gateway->getTestMode());
    }

    public function testPurchase()
    {
        $this->setMockHttpResponse('PurchaseSuccess.txt');

        $response = $this->gateway->purchase([
            'amount' => '10.00',
            'returnUrl' => 'https://example.com/return',
            'notifyUrl' => 'https://example.com/notify',
            'transactionId' => uniqid(),
            'clientIp' => '127.0.0.1',
            'description' => 'orderdesc01',
            'paymentMethod' => 'ideal',
            'issuer' => 'ABNANL2A',
        ])->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertNotNull($response->getRedirectUrl());
        $this->assertEquals('GET', $response->getRedirectMethod());
        $this->assertEquals('123abc', $response->getTransactionReference());
        $this->assertNull($response->getMessage());
    }
}
