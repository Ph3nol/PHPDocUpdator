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
    protected $includes;
    protected $excludes;
    protected $files;
    protected $finder;
    protected $finderDirectories;

    /**
     * Constructor.
     *
     * @param array $includes Folders to include
     * @param array $excludes Folders to exclude
     */
    public function __construct(array $includes = array(), array $excludes = array())
    {
        $this->includes = $includes;
        $this->excludes = $excludes;
        $this->files    = array();

        $finder = new Finder();
        $finder
            ->files()
            ->name('*.php');

        $finderDirectories = new Finder();
        $finderDirectories
            ->directories();

        $this->finder            = $finder;
        $this->finderDirectories = $finderDirectories;

        $this->toFinder($this->finder);
        $this->toFinder($this->finderDirectories);
    }

    /**
     * Loader folders into Finder service.
     *
     * @param Finder $finder Finder service
     *
     * @return array
     */
    protected function toFinder(Finder $finder = null)
    {
        if (null == $finder) {
            $finder = $this->finder;
        }

        foreach ($this->includes as $folder) {
            if (is_array($folder)) {
                $folder = key($folder);
            }

            $finder->in(ROOT_DIR.'/'.$folder);
        }

        foreach ($this->excludes as $folder) {
            $finder->exclude(ROOT_DIR.'/'.$folder);
        }
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
     * Get Finder service.
     *
     * @return Finder
     */
    public function getFinder()
    {
        return $this->finder;
    }

    /**
     * Get files.
     *
     * @return array
     */
    public function getFiles()
    {
        foreach ($this->finder as $file) {
            $this->add($file);
        }

        return $this->files;
    }
}
