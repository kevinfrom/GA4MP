<?php

namespace kevinfrom\GA4MP\Data;

use kevinfrom\GA4MP\Utility\Formattable;

class Consent
{
    use Formattable;

    /**
     * @var bool $adUserData
     */
    private bool $adUserData;

    /**
     * @var bool $adPersonalization
     */
    private bool $adPersonalization;

    /**
     * @param bool $adUserData
     * @param bool $adPersonalization
     */
    public function __construct(bool $adUserData, bool $adPersonalization)
    {
        $this->setAdUserData($adUserData);
        $this->setAdPersonalization($adPersonalization);
    }

    /**
     * Set ad user data
     *
     * @param bool $adUserData
     *
     * @return $this
     */
    public function setAdUserData(bool $adUserData): self
    {
        $this->adUserData = $adUserData;

        return $this;
    }

    /**
     * Get ad user data
     *
     * @return bool
     */
    public function getAdUserData(): bool
    {
        return $this->adUserData;
    }

    /**
     * Set ad personalization
     *
     * @param bool $adPersonalization
     *
     * @return $this
     */
    public function setAdPersonalization(bool $adPersonalization): self
    {
        $this->adPersonalization = $adPersonalization;

        return $this;
    }

    /**
     * Get ad personalization
     *
     * @return bool
     */
    public function getAdPersonalization(): bool
    {
        return $this->adPersonalization;
    }

    /**
     * Format boolean value as 'GRANTED' or 'DENIED'
     *
     * @param bool $value
     *
     * @return string
     */
    private function formatBool(bool $value): string
    {
        return $value ? 'GRANTED' : 'DENIED';
    }

    /**
     * @inheritDoc
     */
    public function formatData(): array
    {
        return [
            'ad_user_data'       => $this->formatBool($this->getAdUserData()),
            'ad_personalization' => $this->formatBool($this->getAdPersonalization()),
        ];
    }
}
