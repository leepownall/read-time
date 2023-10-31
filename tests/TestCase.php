<?php

namespace Pownall\ReadTime\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Pownall\ReadTime\ReadTimeServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app): array
    {
        return [
            ReadTimeServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        //
    }
}
