<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class InstallApplication extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install-application';

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
      $this->call('config:clear');
      $this->call('migrate:fresh', ['--force' => true, '--seed' => true]);
      $this->call('passport:install', ['--force' => true]);

      Storage::disk('public')->put('installed', 'OK');

      $this->info('Installation completed');
    }
}
