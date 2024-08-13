<?php

namespace ChrisReedIO\OracleHCM;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use ChrisReedIO\OracleHCM\Commands\OracleHCMCommand;

class OracleHCMServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-oracle-hcm')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel_oracle_hcm_table')
            ->hasCommand(OracleHCMCommand::class);
    }
}
