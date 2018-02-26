<?php
namespace LaravelFrontendPresets\BourbonNeatPreset;

use Artisan;
use Illuminate\Support\Arr;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Console\Presets\Preset;

class BourbonNeatPreset extends Preset
{
    /**
     * Install the preset.
     *
     * @return void
     */
    public static function install($withAuth = false)
    {
        static::updatePackages();
        static::updateSass();
        static::removeNodeModules();
    }

    /**
     * Update the given package array.
     *
     * @param  array  $packages
     * @return array
     */
    protected static function updatePackageArray(array $packages)
    {
        $packagesToAdd = ['bourbon' => '^5.0.0', 'bourbon-neat' => '2.1.0'];
        $packagesToRemove = ['bootstrap', 'bootstrap-sass', 'uikit'];
        return $packagesToAdd + Arr::except($packages, $packagesToRemove);
    }

    /**
     * Update the Sass files for the application.
     *
     * @return void
     */
    protected static function updateSass()
    {
        // clean up all the files in the sass folder
        $orphan_sass_files = glob(resource_path('/assets/sass/*.*'));

        foreach($orphan_sass_files as $sass_file)
        {
            (new Filesystem)->delete($sass_file);
        }

        // copy files from the stubs folder
        copy(__DIR__.'/bourbon-neat-stubs/app.scss', resource_path('assets/sass/app.scss'));
    }
}
