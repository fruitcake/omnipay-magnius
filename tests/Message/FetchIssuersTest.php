<?php

namespace Omnipay\Magnius\Tests;

use Omnipay\Common\CreditCard;
use Omnipay\Common\Issuer;
use Omnipay\Common\Message\FetchIssuersResponseInterface;
use Omnipay\Magnius\Message\FetchIssuersRequest;
use Omnipay\Magnius\Message\FetchIssuersResponse;
use Omnipay\Magnius\Message\PurchaseRequest;
use Omnipay\Magnius\Message\PurchaseResponse;
use Omnipay\Magnius\Message\Response;
use Omnipay\Tests\TestCase;

class FetchIssuersTest extends TestCase
{
    /**
     * @var FetchIssuersRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $this->request = new FetchIssuersRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize(
            array(
                'apiKey' => 'bar456',
            )
        );
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('FetchIssuersSuccess.txt');
        $response = $this->request->send();

        $this->assertInstanceOf(FetchIssuersResponse::class, $response);
        $this->assertInstanceOf(FetchIssuersResponseInterface::class, $response);

        $issuers = $response->getIssuers();

        $this->assertTrue($response->isSuccessful());
        $this->assertCount(11, $issuers);

        /** @var Issuer $issuer */
        $issuer = array_values($issuers)[0];
        $this->assertInstanceOf(Issuer::class, $issuer);
        $this->assertEquals('ABNANL2A', $issuer->getId());
        $this->assertEquals('ABN AMRO', $issuer->getName());
        $this->assertEquals('ideal', $issuer->getPaymentMethod());
    }
}
