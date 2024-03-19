<?php

namespace App\Console\Commands;

use App\Events\ChatMessage;
use Illuminate\Console\Command;

class EventTriggerTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test-event';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        event(new ChatMessage('ChatMessage'));
    }
}
