<?php

namespace Tests\Unit;

use Tests\TestCase;

class ApplicationTestCase extends TestCase
{
    protected function getEnvironmentSetUp($app)
    {
        $app['path.lang'] = __DIR__ . '/lang';
    }
}
