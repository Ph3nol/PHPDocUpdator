<?php

namespace Sly\PHPDocUpdator\Manager;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

/**
 * File Manager service.
 *
 * @author Cédric Dugat <ph3@slynett.com>
 */
class FileManager
{
    protected $files;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->files = array();
    }

    /**
     * Add file to the service.
     *
     * @param SplFileInfo $file
     *
     * @return array
     */
    public function add(SplFileInfo $file)
    {
        return $this->files[md5($file->getRealpath())] = array(
            'realPath'         => $file->getRealpath(),
            'relativePath'     => $file->getRelativePath(),
            'relativePathName' => $file->getRelativePathname(),
        );
    }

    /**
     * Get files.
     *
     * @return array
     */
    public function getFiles()
    {
        return $this->files;
    }
}
