<?php

namespace App\Services\User;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Models\MySql\User\UserVoiceSample;
use App\Repositories\User\UserVoiceSampleRepository;
use App\Services\File\FileService;
use App\Services\User\Interfaces\UserVoiceSampleServiceInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class UserVoiceSampleService
 *
 * @package App\Services\User
 */
final class UserVoiceSampleService extends FileService implements UserVoiceSampleServiceInterface
{
    /**
     * Storage disk environment
     */
    protected const ENVIRONMENT = 'public';

    /**
     * Audio files storage name
     */
    protected const FOLDER = 'user_voice_samples';

    /**
     * @var UserVoiceSampleRepository
     */
    protected UserVoiceSampleRepository $userVoiceSampleRepository;

    /**
     * UserVoiceSampleService constructor
     */
    public function __construct()
    {
        /** @var UserVoiceSampleRepository userVoiceSampleRepository */
        $this->userVoiceSampleRepository = new UserVoiceSampleRepository();
    }

    /**
     * @param int $authId
     * @param string $content
     * @param string $mime
     * @param string $extension
     * @param string|null $requestId
     *
     * @return UserVoiceSample
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createAudio(
        int $authId,
        string $content,
        string $mime,
        string $extension,
        ?string $requestId
    ) : UserVoiceSample
    {
        /**
         * Uploading file
         */
        $filePath = $this->uploadFile(
            $content,
            $extension,
            self::FOLDER
        );

        /**
         * Getting file duration
         */
        $duration = $this->getFileDuration(
            $filePath
        );

        /**
         * Creating user voice sample
         */
        return $this->userVoiceSampleRepository->store(
            $authId,
            $requestId,
            $filePath,
            $duration,
            $mime
        );
    }

    /**
     * @param int $authId
     * @param array $userVoiceSampleFiles
     *
     * @return Collection
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createAudios(
        int $authId,
        array $userVoiceSampleFiles
    ) : Collection
    {
        /**
         * Preparing user voice samples collection
         */
        $voiceSamples = new Collection();

        /** @var array $userVoiceSampleFile */
        foreach ($userVoiceSampleFiles as $userVoiceSampleFile) {

            /**
             * Pushing created user voice sample to response
             */
            $voiceSamples->push(
                $this->createAudio(
                    $authId,
                    $userVoiceSampleFile['content'],
                    $userVoiceSampleFile['mime'],
                    $userVoiceSampleFile['extension'],
                    $userVoiceSampleFile['request_id'] ?? null
                )
            );
        }

        return $voiceSamples;
    }

    /**
     * @param UserVoiceSample $userVoiceSample
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteAudio(
        UserVoiceSample $userVoiceSample
    ) : bool
    {
        /**
         * Deleting file from storage
         */
        $this->deleteFile(
            $userVoiceSample->url
        );

        /**
         * Deleting user voice sample
         */
        return $this->userVoiceSampleRepository->delete(
            $userVoiceSample
        );
    }

    /**
     * @param Collection $userVoiceSamples
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteAudios(
        Collection $userVoiceSamples
    ) : bool
    {
        /** @var UserVoiceSample $userVoiceSample */
        foreach ($userVoiceSamples as $userVoiceSample) {

            /**
             * Deleting file from storage
             */
            $this->deleteFile(
                $userVoiceSample->url
            );
        }

        /**
         * Deleting user voice samples
         */
        return $this->userVoiceSampleRepository->deleteByIds(
            $userVoiceSamples->pluck('id')
                ->values()
                ->toArray()
        );
    }
}
