<?php

namespace Sly\PHPDocUpdator\Generator;

/**
 * DocGenerator service.
 * To generate PHPDoc from array or phpDocumentor\Reflection\DocBlock object.
 *
 * @author Cédric Dugat <ph3@slynett.com>
 */
class DocGenerator
{
    protected $file;

    /**
     * Constructor.
     *
     * @param array $file File informations
     */
    public function __construct(array $file)
    {
        $this->file = $file;

        $this->fileMaker();
    }

    /**
     * Make file.
     */
    protected function fileMaker()
    {
        /**
         * @todo
         */
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

        foreach ($parserData['tags'] as $tagName => $tag) {
            $docBlockTagLines = array(
                ' * @'.$tagName,
                $tag['type'],
                $tag['variableName'],
                $tag['description'],
            );

            $docBlockLines[] = implode(' ', $docBlockTagLines);
        }

        $docBlockLines[] = ' */';

        return implode("\n", $docBlockLines);
    }
}
