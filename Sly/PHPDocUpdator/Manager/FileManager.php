<?php

namespace Sly\PHPDocUpdator\Manager;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Sly\PHPDocUpdator\Parser\FileParser;

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
        $parsingData = array();

        foreach (FileParser::getClassesFromFilePath($file->getRealpath()) as $class) {
            require_once $file->getRealpath();

            $fileParser = new FileParser($class);
            $parsingData = $fileParser->getData();
        }

        return $this->files[md5($file->getRealpath())] = array(
            'realPath'         => $file->getRealpath(),
            'relativePath'     => $file->getRelativePath(),
            'relativePathName' => $file->getRelativePathname(),
            'parsingData'      => $parsingData,
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
