<?php

namespace kevinfrom\GA4MP\Utility;

trait Formattable
{
    /**
     * Returns the data formatted as an array
     *
     * @return array
     */
    abstract public function formatData(): array;

    /**
     * Returns the data formatted as a JSON string
     *
     * @return string
     */
    final public function toJSON(): string
    {
        return json_encode($this->formatData());
    }

    /**
     * Returns the data formatted as a JSON string
     *
     * @return string
     */
    final public function __toString(): string
    {
        return $this->toJSON();
    }
}
