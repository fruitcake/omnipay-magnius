<?php

namespace Omnipay\Magnius\Tests;

use Omnipay\Common\CreditCard;
use Omnipay\Common\Issuer;
use Omnipay\Common\Message\FetchIssuersResponseInterface;
use Omnipay\Magnius\Message\CreateCustomerRequest;
use Omnipay\Magnius\Message\CreateCustomerResponse;
use Omnipay\Magnius\Message\FetchIssuersRequest;
use Omnipay\Magnius\Message\FetchIssuersResponse;
use Omnipay\Magnius\Message\PurchaseRequest;
use Omnipay\Magnius\Message\PurchaseResponse;
use Omnipay\Magnius\Message\Response;
use Omnipay\Tests\TestCase;

class CreateCustomerRequestTest extends TestCase
{
    /**
     * @var CreateCustomerRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $this->request = new CreateCustomerRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize(
            array(
                'apiKey' => 'bar456',
                'organisationId' => 'foo123',
                'card' => [
                    'email' => 'barry@fruitcake.nl',
                    'country' => 'NL',
                    'city' => 'Eindhoven',
                    'address1' => 'My street 1',
                    'phone' => '+311234567',
                    'company' => 'Fruitcake',
                ]
            )
        );
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('CreateCustomerSuccess.txt');
        $response = $this->request->send();

        $this->assertInstanceOf(CreateCustomerResponse::class, $response);

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('qux123', $response->getCustomerReference());
    }
}
