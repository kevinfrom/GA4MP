<?php

namespace kevinfrom\GA4MP\Data;

use kevinfrom\GA4MP\Utility\Formattable;

class UserProvidedData
{
    use Formattable;

    /**
     * @var string[] $emailAddresses The email addresses of the user. Do not SHA256 hash this field, since it will be hashed before being sent to Google Analytics.
     */
    private array $emailAddresses;

    /**
     * @var string[] $phoneNumbers The phone numbers of the user. Include the country code in the phone number. Do not SHA256 hash this field, since it will be hashed before being sent to Google Analytics.
     */
    private array $phoneNumbers;

    /**
     * @var \kevinfrom\GA4MP\Data\UserAddress[] $addresses
     */
    private array $addresses = [];

    /**
     * @param string[]                            $emailAddresses
     * @param string[]                            $phoneNumbers
     * @param \kevinfrom\GA4MP\Data\UserAddress[] $addresses
     */
    public function __construct(array $emailAddresses = [], array $phoneNumbers = [], array $addresses = [])
    {
        $this->emailAddresses = $emailAddresses;
        $this->phoneNumbers   = $phoneNumbers;

        foreach ($addresses as $address) {
            $this->addAddress($address);
        }
    }

    /**
     * Add email address
     *
     * @param string $emailAddress The email address of the user. Do not SHA256 hash this field, since it will be hashed before being sent to Google Analytics.
     *
     * @return $this
     */
    public function addEmailAddress(string $emailAddress): self
    {
        $this->emailAddresses[] = $emailAddress;

        return $this;
    }

    /**
     * Get email addresses
     *
     * @return string[]
     */
    public function getEmailAddresses(): array
    {
        return $this->emailAddresses;
    }

    /**
     * Add phone number
     *
     * @param string $phoneNumber The phone number of the user. Include the country code in the phone number. Do not SHA256 hash this field, since it will be hashed before being sent to Google Analytics.
     *
     * @return $this
     */
    public function addPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumbers[] = $phoneNumber;

        return $this;
    }

    /**
     * Get phone numbers
     *
     * @return string[]
     */
    public function getPhoneNumbers(): array
    {
        return $this->phoneNumbers;
    }

    /**
     * Add customer address
     *
     * @param \kevinfrom\GA4MP\Data\UserAddress $address
     *
     * @return $this
     */
    public function addAddress(UserAddress $address): self
    {
        $this->addresses[] = $address;

        return $this;
    }

    /**
     * Get addresses
     *
     * @return \kevinfrom\GA4MP\Data\UserAddress[]
     */
    public function getAddresses(): array
    {
        return $this->addresses;
    }

    /**
     * @inheritDoc
     */
    public function formatData(): array
    {
        return array_filter([
            'sha256_email_address' => $this->emailAddresses,
            'sha256_phone_number'  => $this->phoneNumbers,
            'address'              => array_map(function (UserAddress $address) {
                return $address->formatData();
            }, $this->getAddresses()),
        ]);
    }
}
