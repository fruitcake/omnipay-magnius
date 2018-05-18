<?php

namespace Omnipay\Magnius\Tests;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Magnius\Message\CreateCustomerRequest;
use Omnipay\Magnius\Message\CreateCustomerResponse;
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
                    'postcode' => '1234AB',
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
        $this->assertEquals('qux123', $response->getCustomerId());
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $this->assertSame('Fruitcake', $data['company_name']);
        $this->assertSame('barry@fruitcake.nl', $data['email_address']);
    }

    public function testGetDataIdealWithoutIssuer()
    {
        $this->expectException(InvalidRequestException::class);
        $this->expectExceptionMessage('The postcode parameter is required');

        $this->request->getCard()->setPostcode(null);
        $data = $this->request->getData();
    }
}
