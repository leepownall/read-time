<?php

namespace Pownall\ReadTime;

use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ReadTimeServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('readtime')
            ->hasConfigFile()
            ->publishesServiceProvider(ReadTimeServiceProvider::class);
    }

    public function bootingPackage(): void
    {
        Blade::directive('readtime', function (int $wordCount): string {
            return new ReadTime($wordCount);
        });
    }
}
