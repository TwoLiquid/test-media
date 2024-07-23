<?php

namespace App\Microservices\Auth;

use App\Microservices\Auth\Interfaces\AuthMicroservicesInterface;
use App\Microservices\Auth\Traits\AuthTrait;
use App\Microservices\ExceptionTrait;
use GuzzleHttp\Client;

/**
 * Class AuthMicroservice
 *
 * @package App\Microservices\Auth
 */
class AuthMicroservice implements AuthMicroservicesInterface
{
    use ExceptionTrait, AuthTrait;

    /**
     * Appearance constant
     */
    const APPEARANCE = 'auth';

    /**
     * Chat microservice hosting url
     *
     * @var string
     */
    protected string $apiUrl;

    /**
     * Request headers
     *
     * @var array
     */
    protected array $headers;

    /**
     * Guzzle http requests client
     *
     * @var Client
     */
    protected Client $client;

    /**
     * AuthMicroservice constructor
     */
    public function __construct()
    {
        /**
         * Api parameters initialization
         */
        $this->apiUrl = config('microservices.auth.url');

        $this->headers = [
            'X-Authorization' => config('microservices.auth.key'),
            'X-Localization'  => request()->header('X-Localization'),
            'Content-Type'    => 'application/json'
        ];

        $this->client = new Client([
            'headers' => $this->headers
        ]);
    }
}
