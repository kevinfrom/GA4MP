<?php

namespace kevinfrom\GA4MP\Events;

use kevinfrom\GA4MP\Utility\Formattable;

abstract class SimpleEvent
{
    use Formattable;

    /**
     * @var string $eventName
     */
    protected string $eventName;

    /**
     * @var array $eventParams
     */
    protected array $eventParams;

    /**
     * @var bool $debug_mode
     */
    protected bool $debug_mode = false;

    /**
     * @param string $eventName
     * @param array  $eventParams
     */
    public function __construct(string $eventName, array $eventParams)
    {
        $this->eventName   = $eventName;
        $this->eventParams = $eventParams;
    }

    /**
     * Get event name
     *
     * @return string
     */
    public function getEventName(): string
    {
        return $this->eventName;
    }

    /**
     * Set event name
     *
     * @param string $eventName
     *
     * @return $this
     */
    public function setEventName(string $eventName): self
    {
        $this->eventName = $eventName;

        return $this;
    }

    /**
     * Get event params
     *
     * @param string|null $key
     *
     * @return array|mixed|null
     */
    public function getEventParams(?string $key = null)
    {
        if ($key) {
            return $this->eventParams[$key] ?? null;
        }

        return $this->eventParams;
    }

    /**
     * Set event params
     *
     * @param array $eventParams
     *
     * @return $this
     */
    public function setEventParams(array $eventParams): self
    {
        $this->eventParams = $eventParams;

        return $this;
    }

    /**
     * Get debug mode
     *
     * @return bool
     */
    public function getDebugMode(): bool
    {
        return $this->debug_mode;
    }

    /**
     * Set debug mode
     *
     * @param bool $debugMode
     *
     * @return $this
     */
    public function setDebugMode(bool $debugMode): self
    {
        $this->debug_mode = $debugMode;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function formatData(): array
    {
        return array_filter([
            'name'   => $this->eventName,
            'params' => $this->eventParams,
        ]);
    }
}