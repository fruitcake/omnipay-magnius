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
        $response = $this->request->send();

        $this->assertInstanceOf(FetchIssuersResponse::class, $response);
        $this->assertInstanceOf(FetchIssuersResponseInterface::class, $response);

        $issuers = $response->getIssuers();

        $this->assertTrue($response->isSuccessful());
        $this->assertCount(10, $issuers);
        $this->assertInstanceOf(Issuer::class, array_values($issuers)[0]);
    }
}
