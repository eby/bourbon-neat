<?php
namespace BourbonNeatPresets\BourbonNeatPreset;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Console\PresetCommand;

class BourbonNeatPresetServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        PresetCommand::macro('bourbon-neat', function ($command) {
            BourbonNeatPreset::install(false);
            $command->info('Bourbon and Neat scaffolding installed successfully.');
            $command->comment('Please run "npm install && npm run dev" to compile your fresh scaffolding.');
        });
    }
}
