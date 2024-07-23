<?php

namespace App\Microservices\Auth\Traits;

use App\Exceptions\MicroserviceException;
use App\Microservices\Auth\Responses\BaseResponse;
use App\Microservices\Auth\Responses\UserResponse;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Trait AuthTrait
 *
 * @package App\Microservices\Auth\Traits
 */
trait AuthTrait
{
    /**
     * @return BaseResponse
     *
     * @throws GuzzleException
     * @throws MicroserviceException
     */
    public function test() : BaseResponse
    {
        try {
            $response = $this->client->request(
                'GET',
                $this->apiUrl . '/auth/test'
            );

            $responseData = json_decode(
                $response->getBody()->getContents()
            );

            return new BaseResponse(
                $responseData->message
            );
        } catch (Exception $exception) {
            throw $this->executeException(
                $exception,
                trans('exceptions/microservice/auth/auth.' . __FUNCTION__)
            );
        }
    }

    /**
     * @param string $token
     * 
     * @return UserResponse
     *
     * @throws GuzzleException
     * @throws MicroserviceException
     */
    public function checkToken(
        string $token
    ) : UserResponse
    {
        try {
            $this->headers += [
                'Authorization' => 'Bearer ' . $token
            ];

            $this->client = new Client([
                'headers' => $this->headers
            ]);

            $response = $this->client->request(
                'GET',
                $this->apiUrl . '/auth/check/token'
            );

            $responseData = json_decode(
                $response->getBody()->getContents()
            );

            return new UserResponse(
                $responseData->user,
                $responseData->message
            );
        } catch (Exception $exception) {
            throw $this->executeException(
                $exception,
                trans('exceptions/microservice/auth/auth.' . __FUNCTION__)
            );
        }
    }
}
