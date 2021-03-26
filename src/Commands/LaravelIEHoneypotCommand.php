<?php

namespace CraigPotter\LaravelIEHoneypot\Commands;

use Illuminate\Console\Command;

class LaravelIEHoneypotCommand extends Command
{
    public $signature = 'laravel-ie-honeypot';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
