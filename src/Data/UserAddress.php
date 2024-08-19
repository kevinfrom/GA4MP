<?php

namespace kevinfrom\GA4MP\Data;

use kevinfrom\GA4MP\Utility\Hasher;
use kevinfrom\GA4MP\Utility\Formattable;

class UserAddress
{
    use Formattable;

    /**
     * @var string|null $firstName The first name of the user.
     */
    private ?string $firstName;

    /**
     * @var string|null $lastName The last name of the user.
     */
    private ?string $lastName;

    /**
     * @var string|null $city The city of the user.
     */
    private ?string $city;

    /**
     * @var string|null $street The street of the user.
     */
    private ?string $street;

    /**
     * @var string|null $postalCode The postal code of the user.
     */
    private ?string $postalCode;

    /**
     * @var string|null $country The country of the user.
     */
    private ?string $country;

    /**
     * @var string|null $region The region of the user.
     */
    private ?string $region;

    /**
     * @param string|null $firstName
     * @param string|null $lastName
     * @param string|null $city
     * @param string|null $street
     * @param string|null $postalCode
     * @param string|null $country
     * @param string|null $region
     */
    public function __construct(
        ?string $firstName = null,
        ?string $lastName = null,
        ?string $city = null,
        ?string $street = null,
        ?string $postalCode = null,
        ?string $country = null,
        ?string $region = null
    ) {
        $this->firstName  = $firstName;
        $this->lastName   = $lastName;
        $this->city       = $city;
        $this->street     = $street;
        $this->postalCode = $postalCode;
        $this->country    = $country;
        $this->region     = $region;
    }

    /**
     * Get first name
     *
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * Set first name
     *
     * @param string|null $firstName
     *
     * @return self
     */
    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get last name
     *
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * Set last name
     *
     * @param string|null $lastName
     *
     * @return self
     */
    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get city
     *
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * Set city
     *
     * @param string|null $city
     *
     * @return self
     */
    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get street
     *
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * Set street
     *
     * @param string|null $street
     *
     * @return self
     */
    public function setStreet(?string $street): self
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get postal code
     *
     * @return string|null
     */
    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    /**
     * Set postal code
     *
     * @param string|null $postalCode
     *
     * @return self
     */
    public function setPostalCode(?string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get country
     *
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * Set country
     *
     * @param string|null $country
     *
     * @return self
     */
    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get region
     *
     * @return string|null
     */
    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * Set region
     *
     * @param string|null $region
     *
     * @return self
     */
    public function setRegion(?string $region): self
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function formatData(): array
    {
        return array_filter([
            'sha256_first_name' => $this->firstName ? Hasher::hashForMP($this->firstName) : null,
            'sha256_last_name'  => $this->lastName ? Hasher::hashForMP($this->lastName) : null,
            'sha256_street'     => $this->street ? Hasher::hashForMP($this->street) : null,
            'city'              => $this->city,
            'region'            => $this->region,
            'postal_code'       => $this->postalCode,
            'country'           => $this->country,
        ]);
    }
}
