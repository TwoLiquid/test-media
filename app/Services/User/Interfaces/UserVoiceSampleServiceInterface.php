<?php

namespace App\Services\User\Interfaces;

use App\Models\MySql\User\UserVoiceSample;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface UserVoiceSampleServiceInterface
 *
 * @package App\Services\User\Interfaces
 */
interface UserVoiceSampleServiceInterface
{
    /**
     * This method provides creating data
     *
     * @param int $authId
     * @param string $content
     * @param string $mime
     * @param string $extension
     * @param string|null $requestId
     *
     * @return UserVoiceSample
     */
    public function createAudio(
        int $authId,
        string $content,
        string $mime,
        string $extension,
        ?string $requestId
    ) : UserVoiceSample;

    /**
     * This method provides creating data
     *
     * @param int $authId
     * @param array $userVoiceSampleFiles
     *
     * @return Collection
     */
    public function createAudios(
        int $authId,
        array $userVoiceSampleFiles
    ) : Collection;

    /**
     * This method provides deleting data
     *
     * @param UserVoiceSample $userVoiceSample
     *
     * @return bool
     */
    public function deleteAudio(
        UserVoiceSample $userVoiceSample
    ) : bool;

    /**
     * This method provides deleting data
     *
     * @param Collection $userVoiceSamples
     *
     * @return bool
     */
    public function deleteAudios(
        Collection $userVoiceSamples
    ) : bool;
}
