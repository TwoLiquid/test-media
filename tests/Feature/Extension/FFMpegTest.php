<?php

namespace Tests\Feature\Extension;

use Tests\TestCase;
use RuntimeException;

/**
 * Class FFMpegTest
 *
 * @package Tests\Feature\Extension
 */
class FFMpegTest extends TestCase
{
    /**
     * A basic feature test extension ff-mpeg test.
     *
     * @return void
     */
    public function test_extension_ffmpeg()
    {
        if (shell_exec('which ffmpeg') === null) {
            throw new RuntimeException(
                'FFMpeg not installed'
            );
        }

        $this->assertTrue(true);
    }
}
