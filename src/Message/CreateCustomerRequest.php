<?php

namespace Omnipay\Magnius\Message;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 *
 * @method \Omnipay\Magnius\Message\CreateCustomerResponse send()
 */
class CreateCustomerRequest extends AbstractRequest
{

    /**
     * @return array
     */
    public function getData()
    {
        $this->validate('apiKey', 'card');

        $card = $this->getCard();

        foreach ([
             'email',
             'city',
             'country',
             'phone',
             'address1',
             'postcode'
         ] as $key) {
            $getter = 'get'.ucfirst($key);
            if (! $card->{$getter}()) {
                throw new InvalidRequestException("The $key parameter is required");
            }
        }

        $data = [
            'organisation' => $this->getOrganisationId(),
            'city' => $card->getCity(),
            'country_code' => $card->getCountry(),
            'email_address' => $card->getEmail(),
            'gender' => in_array(strtolower($card->getGender()), ['female', 'F']) ? 'female' : 'male',
            'phone_number' => $card->getPhone(),
            'postal_code' => $card->getPostcode(),
            'street_address' => trim($card->getAddress1() . ' ' . $card->getAddress2()),
        ];

        if ($card->getCompany()) {
            $data['company_name'] = $card->getCompany();
        } elseif ($card->getFirstName() && $card->getLastName()) {
            $data['first_name'] = $card->getFirstName();
            $data['last_name'] = $card->getLastName();
        } else {
            throw new InvalidRequestException("Either the Company or First+Last Name are required");
        }

        return $data;
    }

    protected function createResponse($data)
    {
        return $this->response = new CreateCustomerResponse($this, $data);
    }

    protected function getRequestUrl()
    {
        return "customer";
    }
}
