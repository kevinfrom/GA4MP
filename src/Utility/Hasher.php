<?php

namespace kevinfrom\GA4MP\Utility;

class Hasher
{

    /**
     * Hash and encode a value for Measurement Protocol
     *
     * @param string $value
     *
     * @return string
     */
    public static function hashForMP(string $value): string
    {
        // Convert a string value to UTF-8 encoded text.
        $value_utf8 = mb_convert_encoding($value, 'UTF-8');

        // Compute the hash (digest) using the SHA-256 algorithm.
        $hash_sha256 = hash('sha256', $value_utf8, true);

        // Convert buffer to byte array.
        $hash_array = unpack('C*', $hash_sha256);

        // Return a hex-encoded string.
        return array_reduce($hash_array, function ($carry, $item) {
            return $carry . str_pad(dechex($item), 2, '0', STR_PAD_LEFT);
        }, '');
    }
}
