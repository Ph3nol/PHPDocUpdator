<?php

namespace Sly\PHPDocUpdator\Tests\Manager;

use Sly\PHPDocUpdator\Manager\FileManager;

/**
 * FileManager tests.
 *
 * @author Cédric Dugat <ph3@slynett.com>
 */
class FileManagerTest extends \PHPUnit_Framework_TestCase
{
    protected $fileManager;

    /**
     * Test constructor.
     */
    public function testConstructor()
    {
        $this->fileManager = new FileManager();
    }
}
