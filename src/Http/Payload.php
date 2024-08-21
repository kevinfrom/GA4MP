<?php

namespace kevinfrom\GA4MP\Http;

use kevinfrom\GA4MP\Data\Consent;
use kevinfrom\GA4MP\Utility\Formattable;
use kevinfrom\GA4MP\Events\SimpleEvent;
use kevinfrom\GA4MP\Data\UserProvidedData;

class Payload
{
    use Formattable;

    /**
     * @var string $clientId
     */
    private string $clientId;

    /**
     * @var string|null $userId
     */
    private ?string $userId = null;

    /**
     * @var \kevinfrom\GA4MP\Events\SimpleEvent[] $events
     */
    private array $events = [];

    /**
     * @var \kevinfrom\GA4MP\Data\UserProvidedData|null $userProvidedData
     */
    private ?UserProvidedData $userProvidedData = null;

    /**
     * @var \kevinfrom\GA4MP\Data\Consent|null $consent
     */
    private ?Consent $consent = null;

    /**
     * @param string                              $clientId
     * @param \kevinfrom\GA4MP\Events\SimpleEvent $firstEvent
     */
    public function __construct(string $clientId, SimpleEvent $firstEvent)
    {
        $this->setClientId($clientId);
        $this->addEvent($firstEvent);
    }

    /**
     * Set client ID
     *
     * @param string $clientId
     *
     * @return $this
     */
    public function setClientId(string $clientId): self
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * Get client ID
     *
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * Set user ID
     *
     * @param string $userId
     *
     * @return $this
     */
    public function setUserId(string $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get user ID
     *
     * @return string|null
     */
    public function getUserId(): ?string
    {
        return $this->userId;
    }

    /**
     * Get events
     *
     * @return \kevinfrom\GA4MP\Events\SimpleEvent[]
     */
    public function getEvents(): array
    {
        return $this->events;
    }

    /**
     * Add event to the payload data
     *
     * @param \kevinfrom\GA4MP\Events\SimpleEvent $event
     *
     * @return $this
     */
    public function addEvent(SimpleEvent $event): self
    {
        $this->events[] = $event;

        return $this;
    }

    /**
     * Set user provided data
     *
     * @param \kevinfrom\GA4MP\Data\UserProvidedData|null $userProvidedData
     *
     * @return $this
     */
    public function setUserProvidedData(?UserProvidedData $userProvidedData): self
    {
        $this->userProvidedData = $userProvidedData;

        return $this;
    }

    /**
     * Get user provided data
     *
     * @return \kevinfrom\GA4MP\Data\UserProvidedData|null
     */
    public function getUserProvidedData(): ?UserProvidedData
    {
        return $this->userProvidedData;
    }

    /**
     * Set consent
     *
     * @param \kevinfrom\GA4MP\Data\Consent|null $consent
     *
     * @return $this
     */
    public function setConsent(?Consent $consent): self
    {
        $this->consent = $consent;

        return $this;
    }

    /**
     * Get consent
     *
     * @return \kevinfrom\GA4MP\Data\Consent|null
     */
    public function getConsent(): ?Consent
    {
        return $this->consent;
    }

    /**
     * @inheritDoc
     */
    public function formatData(): array
    {
        return array_filter([
            'client_id' => $this->getClientId(),
            'events'    => array_map(function (SimpleEvent $event) {
                return $event->formatData();
            }, $this->getEvents()),
            'user_id'   => $this->getUserId(),
            'user_data' => $this->getUserProvidedData() ? $this->getUserProvidedData()->formatData() : null,
            'consent'   => $this->getConsent() ? $this->getConsent()->formatData() : null,
        ]);
    }
}
