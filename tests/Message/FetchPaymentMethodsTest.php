<?php

namespace Omnipay\Magnius\Tests;

use Omnipay\Common\CreditCard;
use Omnipay\Common\Issuer;
use Omnipay\Common\Message\FetchPaymentMethodsResponseInterface;
use Omnipay\Common\PaymentMethod;
use Omnipay\Magnius\Message\FetchIssuersRequest;
use Omnipay\Magnius\Message\FetchIssuersResponse;
use Omnipay\Magnius\Message\FetchPaymentMethodsRequest;
use Omnipay\Magnius\Message\FetchPaymentMethodsResponse;
use Omnipay\Magnius\Message\PurchaseRequest;
use Omnipay\Magnius\Message\PurchaseResponse;
use Omnipay\Magnius\Message\Response;
use Omnipay\Tests\TestCase;

class FetchPaymentMethodsTest extends TestCase
{
    /**
     * @var FetchPaymentMethodsRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $this->request = new FetchPaymentMethodsRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize(
            array(
                'apiKey' => 'bar456',
            )
        );
    }

    public function testSendSuccess()
    {
        $response = $this->request->send();

        $this->assertInstanceOf(FetchPaymentMethodsResponse::class, $response);
        $this->assertInstanceOf(FetchPaymentMethodsResponseInterface::class, $response);

        $methods = $response->getPaymentMethods();

        $this->assertTrue($response->isSuccessful());
        $this->assertCount(2, $methods);
        $this->assertInstanceOf(PaymentMethod::class, array_values($methods)[0]);
    }
}
