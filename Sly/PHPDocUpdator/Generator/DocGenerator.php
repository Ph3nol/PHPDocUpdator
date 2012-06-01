<?php

namespace Sly\PHPDocUpdator\Generator;

use phpDocumentor\Reflection\DocBlock as PHPDocumentorDocBlock;

/**
 * DocGenerator service.
 * To generate PHPDoc from array or phpDocumentor\Reflection\DocBlock object.
 *
 * @author Cédric Dugat <ph3@slynett.com>
 */
class DocGenerator
{
	protected $source;

	/**
	 * Constructor.
	 *
	 * @param array|PHPDocumentorDocBlock $source Source for PHPDoc generation
	 */
	public function __construct($source)
	{
		if (is_object($source) && ($source instanceof PHPDocumentorDocBlock))
		{

		}
		elseif (is_array($source))
		{

		}
		else
		{
			throw new \Exception('DocGenerator must have PHPDocumentorDocBlock object or array given its constructor');
		}
	}

	/**
	 * Get final data from object.
	 *
	 * @param PHPDocumentorDocBlock $source Source
	 */
	protected function getFinalDataFromObject(PHPDocumentorDocBlock $source)
	{
	}

	/**
	 * Get final source from array.
	 *
	 * @param array $source Source
	 */
	protected function getFinalSourceFromArray(array $source)
	{
		return $source;
	}
}
