<?php

namespace App\Console\Commands;

use App\Configs\Audio\Alert\AlertSoundConfig;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        dd(AlertSoundConfig::getMaximumSize());
    }
}
