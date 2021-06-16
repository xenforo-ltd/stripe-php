<?php

namespace Stripe\HttpClient;

interface StreamingClientInterface
{
    /**
     * @param string $method The HTTP method being used
     * @param string $absUrl The URL being requested, including domain and protocol
     * @param array $headers Headers to be used in the request (full strings, not KV pairs)
     * @param array $params KV pairs for parameters. Can be nested for arrays and hashes
     * @param bool $hasFile Whether or not $params references a file (via an @ prefix or
     *                         CURLFile)
     *
     * @throws \Stripe\Exception\ApiConnectionException
     * @throws \Stripe\Exception\UnexpectedValueException
     *
     */
    public function requestStreaming($method, $absUrl, $headers, $params, $onSuccess);
}
