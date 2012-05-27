<?php

namespace Sly\PHPDocUpdator\Test\Application;

use Sly\PHPDocUpdator\Application\Application;

/**
 * Application tests.
 *
 * @author Cédric Dugat <ph3@slynett.com>
 */
class ApplicationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test constructor.
     */
    public function testConstructor()
    {
        $application = new Application();
    }

    /**
     * @depends testConstructor
     */
    public function testRunner()
    {

    }
}
