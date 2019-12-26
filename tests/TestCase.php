<?php

namespace Supplycart\Settings\Tests;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return ['Supplycart\Settings\ServiceProvider'];
    }
}