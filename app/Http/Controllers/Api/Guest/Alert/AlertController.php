<?php

namespace App\Http\Controllers\Api\Guest\Alert;

use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\Guest\Alert\Interfaces\AlertControllerInterface;
use App\Http\Requests\Api\Guest\Alert\GetForAlertsRequest;
use App\Repositories\Alert\AlertImageRepository;
use App\Repositories\Alert\AlertSoundRepository;
use App\Transformers\Api\Guest\Alert\AlertTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class AlertController
 *
 * @package App\Http\Controllers\Api\Guest\Alert
 */
final class AlertController extends BaseController implements AlertControllerInterface
{
    /**
     * @var AlertImageRepository
     */
    protected AlertImageRepository $alertImageRepository;

    /**
     * @var AlertSoundRepository
     */
    protected AlertSoundRepository $alertSoundRepository;

    /**
     * AlertController constructor
     */
    public function __construct()
    {
        /** @var AlertImageRepository alertImageRepository */
        $this->alertImageRepository = new AlertImageRepository();

        /** @var AlertSoundRepository alertSoundRepository */
        $this->alertSoundRepository = new AlertSoundRepository();

        parent::__construct();
    }

    /**
     * @param int $alertId
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function getForAlert(
        int $alertId
    ) : JsonResponse
    {
        /**
         * Getting alert images
         */
        $alertImages = $this->alertImageRepository->getForAlert(
            $alertId
        );

        /**
         * Getting alert sounds
         */
        $alertSounds = $this->alertSoundRepository->getForAlert(
            $alertId
        );

        return $this->respondWithSuccess(
            $this->transformItem([], new AlertTransformer(
                $alertImages,
                $alertSounds
            )), trans('validations/api/guest/alert/getForAlert.result.success')
        );
    }

    /**
     * @param GetForAlertsRequest $request
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function getForAlerts(
        GetForAlertsRequest $request
    ) : JsonResponse
    {
        /**
         * Getting alert images
         */
        $alertImages = $this->alertImageRepository->getForAlerts(
            $request->input('alerts_ids')
        );

        /**
         * Getting alert sounds
         */
        $alertSounds = $this->alertSoundRepository->getForAlerts(
            $request->input('alerts_ids')
        );

        return $this->respondWithSuccess(
            $this->transformItem([], new AlertTransformer(
                $alertImages,
                $alertSounds
            )), trans('validations/api/guest/alert/getForAlerts.result.success')
        );
    }
}
