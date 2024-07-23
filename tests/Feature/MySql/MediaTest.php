<?php

namespace Tests\Feature\MySql;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use RuntimeException;
use Exception;

/**
 * Class MediaTest
 *
 * @package Tests\Feature\MySql
 */
class MediaTest extends TestCase
{
    /**
     * A basic feature test mysql media test.
     *
     * @return void
     */
    public function test_mysql_media()
    {
        try {
            DB::connection('mysql')->getPDO();
        } catch (Exception $exception) {
            throw new RuntimeException(
                $exception->getMessage()
            );
        }

        $this->assertTrue(true);
    }
}
