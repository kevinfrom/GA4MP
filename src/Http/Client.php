<?php

namespace kevinfrom\GA4MP\Http;

use GuzzleHttp\Client as GuzzleClient;

class Client
{
    /**
     * @var string The base URL for the Measurement Protocol API
     */
    private string $baseUrl = 'https://www.google-analytics.com';

    /**
     * @var string The URL to which the events will be sent
     */
    private string $collectEndpoint = '/mp/collect';

    /**
     * @var string The URL to which the events will be sent for debugging
     */
    private string $debugEndpoint = '/debug/mp/collect';

    /**
     * @var string The API secret
     */
    private string $apiSecret;

    /**
     * @var string The GA4 measurement ID
     */
    private string $measurementId;

    /**
     * @param string $apiSecret
     * @param string $measurementId
     */
    public function __construct(string $apiSecret, string $measurementId)
    {
        $this->apiSecret     = $apiSecret;
        $this->measurementId = $measurementId;
    }

    /**
     * Get the API secret
     *
     * @return string
     */
    public function getApiSecret(): string
    {
        return $this->apiSecret;
    }

    /**
     * Set the API secret
     *
     * @param string $apiSecret
     *
     * @return $this
     */
    public function setApiSecret(string $apiSecret): self
    {
        $this->apiSecret = $apiSecret;

        return $this;
    }

    /**
     * Get the measurement ID
     *
     * @return string
     */
    public function getMeasurementId(): string
    {
        return $this->measurementId;
    }

    /**
     * Set the measurement ID
     *
     * @param string $measurementId
     *
     * @return $this
     */
    public function setMeasurementId(string $measurementId): self
    {
        $this->measurementId = $measurementId;

        return $this;
    }

    /**
     * Get Guzzle client
     *
     * @return \GuzzleHttp\Client
     */
    private function getGuzzleClient(): GuzzleClient
    {
        return new GuzzleClient([
            'base_uri' => $this->baseUrl,
            'headers'  => [
                'Content-Type' => 'application/json',
            ],
            'query'    => [
                'api_secret'     => $this->apiSecret,
                'measurement_id' => $this->measurementId,
            ],
        ]);
    }

    /**
     * Send the payload to the Measurement Protocol API
     *
     * @param Payload $data
     *
     * @return \kevinfrom\GA4MP\Http\Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send(Payload $data): Response
    {

        $response = $this->getGuzzleClient()->request('POST', $this->collectEndpoint, [
            'body' => $data->toJson(),
        ]);

        $isOk = $response->getStatusCode() >= 200 && $response->getStatusCode() <= 299;

        return new Response($isOk);
    }

    /**
     * Validate the payload data
     *
     * @param Payload $data
     *
     * @return \kevinfrom\GA4MP\Http\Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function validate(Payload $data): Response
    {
        $response = $this->getGuzzleClient()->request('POST', $this->debugEndpoint, [
            'body' => $data->toJson(),
        ]);

        $responseData = json_decode($response->getBody(), true);

        $isOk = $response->getStatusCode() >= 200 && $response->getStatusCode() <= 299;

        return new Response($isOk, $responseData);
    }
}
