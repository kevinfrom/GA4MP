<?php

namespace kevinfrom\GA4MP\Http;

class Response
{
    /**
     * @var bool $ok
     */
    private bool $ok;

    /**
     * @var mixed|null $data
     */
    private $data;

    /**
     * @param bool       $ok
     * @param mixed|null $data
     */
    public function __construct(bool $ok, $data = null)
    {
        $this->ok   = $ok;
        $this->data = $data;
    }

    /**
     * Get is OK
     *
     * @return bool
     */
    public function isOk(): bool
    {
        return $this->ok;
    }

    /**
     * Get data
     *
     * @return mixed|null
     */
    public function getData()
    {
        return $this->data;
    }
}