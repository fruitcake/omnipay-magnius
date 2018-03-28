<?php

namespace Omnipay\Magnius\Tests;

use Omnipay\Common\CreditCard;
use Omnipay\Magnius\Message\CompletePurchaseRequest;
use Omnipay\Magnius\Message\CompletePurchaseResponse;
use Omnipay\Magnius\Message\PurchaseRequest;
use Omnipay\Magnius\Message\Response;
use Omnipay\Tests\TestCase;

class CompletePurchaseTest extends TestCase
{
    /**
     * @var CompletePurchaseRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $this->request = new CompletePurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize(
            array(
                'accountId' => 'foo123',
                'apiKey' => 'bar456',
                'testMode' => true,
                'transactionReference' => '123abc',
            )
        );
    }


    public function testSendSuccess()
    {
        $this->setMockHttpResponse('CompletePurchaseSuccess.txt');
        $response = $this->request->send();

        $this->assertInstanceOf(CompletePurchaseResponse::class, $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('123abc', $response->getTransactionReference());
        $this->assertEquals('5ab365dfdb1dd', $response->getTransactionId());
    }
}
