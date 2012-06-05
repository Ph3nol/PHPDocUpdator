<?php

namespace Sly\PHPDocUpdator\Generator;

use Sly\PHPDocUpdator\Config\ConfigParser;

/**
 * DocGenerator service.
 * To generate PHPDoc from array or phpDocumentor\Reflection\DocBlock object.
 *
 * @author Cédric Dugat <ph3@slynett.com>
 */
class DocGenerator
{
    protected $file;
    protected $docDefaults;

    /**
     * Constructor.
     *
     * @param array $file File informations
     */
    public function __construct(array $file)
    {
        $this->file        = $file;
        $this->docDefaults = $this->getDocDefaults();

        $this->fileMaker();
    }

    /**
     * Get PHP documentation defaults for generation.
     * 
     * @return array
     */
    public function getDocDefaults()
    {
        return array(
            'classComments' => 'This is %name% class.',
        );
    }

    /**
     * Make file.
     */
    protected function fileMaker()
    {
        foreach ($this->file['parsingData'] as $class) {
            $wantedFileDoc = ConfigParser::getWantedDocFromFilePath($this->file['realPath']);

            $this->doClassUpdate($class, $wantedFileDoc);
        }
    }

    /**
     * Do class update.
     * 
     * @param array $classData     Class data
     * @param array $wantedFileDoc Wanted file PHP documentation from options
     */
    protected function doClassUpdate(array $classData, array $wantedFileDoc = array())
    {
        if (false == $classData['comments']) {
            // ...
        }

        /**
         * @todo
         */
    }

    /**
     * Do class method update.
     * 
     * @param array $classData Class data
     */
    protected function doClassMethodUpdate(array $classData)
    {
        
    }

    /**
     * Get doc block.
     *
     * @param array $parserData Parser data
     *
     * @return string
     */
    public static function getDocBlock(array $parserData)
    {
        $docBlockLines = array('/**');

        if (isset($parserData['comments']) && $parserData['comments']) {
            $docBlockLines[] = sprintf(' * %s', $parserData['comments']);
        }

        if (isset($parserData['tags']) && $parserData['tags']) {
            foreach ($parserData['tags'] as $tagName => $tag) {
                $docBlockTagLines = array(
                    ' * @'.$tagName,
                    $tag['type'],
                    $tag['variableName'],
                    $tag['content'],
                );

                $docBlockLines[] = implode(' ', $docBlockTagLines);
            }
        }

        $docBlockLines[] = ' */';

        return implode("\n", $docBlockLines);
    }
}
