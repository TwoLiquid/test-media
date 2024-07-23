<?php

namespace Tests\Feature\Http;

use App\Microservices\Auth\AuthMicroservice;
use Tests\TestCase;
use Exception;
use RuntimeException;

/**
 * Class AuthTest
 *
 * @package Tests\Feature\Http
 */
class AuthTest extends TestCase
{
    /**
     * A basic feature test http auth test.
     *
     * @return void
     */
    public function test_http_auth()
    {
        $authMicroservice = app(AuthMicroservice::class);

        try {
            $authMicroservice->test();
        } catch (Exception $exception) {
            throw new RuntimeException(
                $exception->getMessage()
            );
        }

        $this->assertTrue(true);
    }
}
