<?php

namespace Database\Seeders;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Services\Alert\AlertImageService;
use Illuminate\Database\Seeder;

/**
 * Class AlertImageSeeder
 *
 * @package Database\Seeders
 */
class AlertImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function run()
    {
        /** @var AlertImageService $alertImageService */
        $alertImageService = app(AlertImageService::class);

        /**
         * Importing default alert images
         */
        $alertImageService->importResourceImages();
    }
}
