<?php

namespace Laratrade\GDAX\Tests\Integration;

use Laratrade\GDAX\GDAXServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * @inheritdoc
     */
    protected function getEnvironmentSetUp($app)
    {
        //
    }

    /**
     * @inheritdoc
     */
    protected function getPackageProviders($app)
    {
        return [
            GDAXServiceProvider::class,
        ];
    }
}
