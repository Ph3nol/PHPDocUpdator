<?php

namespace Sly\PHPDocUpdator\Tests\Config;

use Sly\PHPDocUpdator\Config\ConfigParser;

/**
 * ConfigParser tests.
 *
 * @author Cédric Dugat <ph3@slynett.com>
 */
class ConfigParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test constructor.
     *
     * @depends __construct
     */
    public function testConstructor()
    {
        $configParser = new ConfigParser();

        $this->assertTrue(is_array($configParser));
        $this->assertGreaterThan(count($configParser), 0);
    }
}
