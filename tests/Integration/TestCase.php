<?php

namespace Laratrade\GDAX\Tests\Integration;

use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * @inheritdoc
     */
    protected function getPackageProviders(Application $app): array
    {
        return [
            //
        ];
    }
}
