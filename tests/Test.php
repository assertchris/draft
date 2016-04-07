<?php

namespace Draft\Draft\Test;

use Mockery;
use PHPUnit_Framework_TestCase;

abstract class Test extends PHPUnit_Framework_TestCase
{
    /**
     * @inheritdoc
     */
    public function tearDown()
    {
        parent::tearDown();
        Mockery::close();
    }
}
