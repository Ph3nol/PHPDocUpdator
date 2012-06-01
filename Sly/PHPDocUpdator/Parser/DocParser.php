<?php

namespace Sly\PHPDocUpdator\Parser;

use phpDocumentor\Reflection\DocBlock as PHPDocumentorDocBlock;

/**
 * DocParser service.
 *
 * @author Cédric Dugat <ph3@slynett.com>
 */
class DocParser
{
    protected $source;

    /**
     * Constructor.
     *
     * @param array|PHPDocumentorDocBlock $source Source for PHPDoc generation
     */
    public function __construct($source)
    {
        $this->source = $source;
    }

    /**
     * Get final data from object.
     *
     * @return array
     */
    protected function getFinalDataFromObject()
    {
        $finalDataTags = array();

        foreach ($this->source->getTags() as $tag) {
            $finalDataTags[$tag->getName()] = array(
                'content'      => $tag->getContent(),
                'description'  => $tag->getDescription(),
                'type'         => $tag->getType(),
                'variableName' => $tag->getVariableName(),
                'lineNumber'   => $tag->getLineNumber(),
            );
        }

        return array(
            'tags' => $finalDataTags,
        );
    }

    /**
     * Get final source from array.
     *
     * @return array
     */
    protected function getFinalSourceFromArray()
    {
        return $this->source;
    }

    /**
     * Get data.
     * 
     * @return array
     */
    public function getData()
    {
        if (is_object($this->source) && ($this->source instanceof PHPDocumentorDocBlock)) {
            return $this->getFinalDataFromObject();
        } elseif (is_array($this->source)) {
            return $this->getFinalDataFromArray();
        } else {
            throw new \Exception('DocGenerator must have a PHPDocumentorDocBlock object or an array given to its constructor');
        }
    }
}
