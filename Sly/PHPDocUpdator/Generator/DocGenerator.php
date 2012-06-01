<?php

namespace Sly\PHPDocUpdator\Generator;

use Sly\PHPDocUpdator\Parser\DocParser;

/**
 * DocGenerator service.
 * To generate PHPDoc from array or phpDocumentor\Reflection\DocBlock object.
 *
 * @author Cédric Dugat <ph3@slynett.com>
 */
class DocGenerator
{
    protected $docParserData;

    /**
     * Constructor.
     * 
     * @param DocParser $docParser Doc Parser service
     */
    public function __construct(DocParser $docParser)
    {
        $this->docParserData = $docParser->getData();
    }

    /**
     * Get doc block.
     *
     * @return string
     */
    public function getDocBlock()
    {
        $docBlockLines = array('/**');

        foreach ($this->docParserData['tags'] as $tagName => $tag) {
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
