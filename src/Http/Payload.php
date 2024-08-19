<?php

namespace kevinfrom\GA4MP\Http;

use kevinfrom\GA4MP\Data\Consent;
use kevinfrom\GA4MP\Utility\Formattable;
use kevinfrom\GA4MP\Events\Event;
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
     * @var \kevinfrom\GA4MP\PayloadData\Events\Event[] $events
     */
    private array $events = [];

    /**
     * @var \kevinfrom\GA4MP\PayloadData\UserProvidedData|null $userProvidedData
     */
    private ?UserProvidedData $userProvidedData = null;

    /**
     * @var \kevinfrom\GA4MP\PayloadData\Consent|null $consent
     */
    private ?Consent $consent = null;

    /**
     * @param string                                    $clientId
     * @param \kevinfrom\GA4MP\PayloadData\Events\Event $firstEvent
     */
    public function __construct(string $clientId, Event $firstEvent)
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
     * @return \kevinfrom\GA4MP\PayloadData\Events\Event[]
     */
    public function getEvents(): array
    {
        return $this->events;
    }

    /**
     * Add event to the payload data
     *
     * @param \kevinfrom\GA4MP\PayloadData\Events\Event $event
     *
     * @return $this
     */
    public function addEvent(Event $event): self
    {
        $this->events[] = $event;

        return $this;
    }

    /**
     * Set user provided data
     *
     * @param \kevinfrom\GA4MP\PayloadData\UserProvidedData|null $userProvidedData
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
     * @return \kevinfrom\GA4MP\PayloadData\UserProvidedData|null
     */
    public function getUserProvidedData(): ?UserProvidedData
    {
        return $this->userProvidedData;
    }

    /**
     * Set consent
     *
     * @param \kevinfrom\GA4MP\PayloadData\Consent|null $consent
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
     * @return \kevinfrom\GA4MP\PayloadData\Consent|null
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
        $data = [
            'client_id' => $this->getClientId(),
            'events'    => array_map(function (Event $event) {
                return $event->formatData();
            }, $this->getEvents()),
        ];

        if ($this->getUserId()) {
            $data['user_id'] = $this->getUserId();
        }

        if ($this->getUserProvidedData()) {
            $data['user_data'] = $this->getUserProvidedData()->formatData();
        }

        if ($this->getConsent()) {
            $data['consent'] = $this->getConsent()->formatData();
        }

        return $data;
    }
}
