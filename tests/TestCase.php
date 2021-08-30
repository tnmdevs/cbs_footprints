<?php

namespace TNM\CBSFootprints\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase as BaseTestCase;
use TNM\CBSFootprints\Providers\CBSFootprintsServiceProvider;

class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    protected function getPackageProviders($app): array
    {
        return [
            CBSFootprintsServiceProvider::class,
        ];
    }
}