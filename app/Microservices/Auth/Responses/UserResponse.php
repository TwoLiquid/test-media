<?php

namespace App\Microservices\Auth\Responses;

/**
 * Class UserResponse
 *
 * @property int $id
 * @property string $email
 * @property string $username
 * @property bool $isAdmin
 * @property string $token
 *
 * @package App\Microservices\Auth\Responses
 */
class UserResponse extends BaseResponse
{
    /**
     * @var int
     */
    public int $id;

    /**
     * @var string
     */
    public string $email;

    /**
     * @var bool
     */
    public bool $isAdmin;

    /**
     * @var string|null
     */
    public ?string $username;

    /**
     * @var string|null
     */
    public ?string $token;

    /**
     * UserResponse constructor
     *
     * @param object $response
     * @param string $message
     */
    public function __construct(
        object $response,
        string $message
    )
    {
        $this->id = $response->id;
        $this->email = $response->email;
        $this->username = $response->username;
        $this->isAdmin = $response->is_admin;
        $this->token = $response->token;

        parent::__construct($message);
    }
}
