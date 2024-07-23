<?php

namespace App\Http\Controllers\Api\General\Alert;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\Alert\Interfaces\AlertSoundControllerInterface;
use App\Http\Requests\Api\General\Alert\Sound\DestroyManyRequest;
use App\Http\Requests\Api\General\Alert\Sound\StoreManyRequest;
use App\Repositories\Alert\AlertSoundRepository;
use App\Services\Alert\AlertSoundService;
use App\Transformers\Api\General\Alert\AlertSoundTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class AlertSoundController
 *
 * @package App\Http\Controllers\Api\General\Alert
 */
final class AlertSoundController extends BaseController implements AlertSoundControllerInterface
{
    /**
     * @var AlertSoundRepository
     */
    protected AlertSoundRepository $alertSoundRepository;

    /**
     * @var AlertSoundService
     */
    protected AlertSoundService $alertSoundService;

    /**
     * AlertSoundController constructor
     */
    public function __construct()
    {
        /** @var AlertSoundRepository alertSoundRepository */
        $this->alertSoundRepository = new AlertSoundRepository();

        /** @var AlertSoundService alertSoundService */
        $this->alertSoundService = new AlertSoundService();

        parent::__construct();
    }

    /**
     * @param int $alertId
     * @param StoreManyRequest $request
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function storeMany(
        int $alertId,
        StoreManyRequest $request
    ) : JsonResponse
    {
        /**
         * Getting alert sounds
         */
        $alertSounds = $this->alertSoundService->createSounds(
            $alertId,
            $request->input('alert_sounds')
        );

        return $this->respondWithSuccess(
            $this->transformCollection($alertSounds, new AlertSoundTransformer),
            trans('validations/api/general/alert/sound/storeMany.result.success')
        );
    }

    /**
     * @param DestroyManyRequest $request
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function destroyMany(
        DestroyManyRequest $request
    ) : JsonResponse
    {
        /**
         * Getting alert sounds
         */
        $alertSounds = $this->alertSoundRepository->getByIds(
            $request->input('alert_sounds_ids')
        );

        /**
         * Deleting alert sounds
         */
        $this->alertSoundService->deleteSounds(
            $alertSounds
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/alert/sound/destroyMany.result.success')
        );
    }
}
