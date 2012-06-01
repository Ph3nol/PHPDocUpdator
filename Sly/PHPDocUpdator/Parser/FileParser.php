<?php

namespace Sly\PHPDocUpdator\Parser;

use phpDocumentor\Reflection\DocBlock as PHPDocumentorDocBlock;
use Sly\PHPDocUpdator\Parser\DocParser;

/**
 * FileParser service.
 *
 * @author Cédric Dugat <ph3@slynett.com>
 */
class FileParser extends \ReflectionClass
{
    protected $parsedData;

    /**
     * Constructor.
     *
     * @param string $className Class name
     */
    public function __construct($className)
    {
        parent::__construct($className);

        $this->parsedData = array();
    }

    /**
     * Get parsed data.
     *
     * @return array
     */
    public function getData()
    {
        $phpDocumentorDocBlock = new PHPDocumentorDocBlock($this);

        $this->parsedData[] = array(
            'comments'  => $this->getDocComment(),
            'docParser' => new DocParser($phpDocumentorDocBlock),
            'methods'   => $this->getParsedMethods(),
        );

        return $this->parsedData;
    }

    /**
     * Get parsed methods.
     *
     * @return array
     */
    protected function getParsedMethods()
    {
        $methods = array();

        foreach ($this->getMethods() as $method) {
            $phpDocumentorDocBlock = new PHPDocumentorDocBlock($method->getDocComment());

            $methods[$method->getName()] = array(
                'comments'  => $method->getDocComment(),
                'docParser' => new DocParser($phpDocumentorDocBlock),
            );
        }

        return $methods;
    }

    /**
     * Get classes from file path.
     *
     * @param string $filePath File path
     *
     * @return array
     */
    public static function getClassesFromFilePath($filePath)
    {
        return self::getClassesFromCode(file_get_contents($filePath));
    }

    /**
     * Get classes from code.
     *
     * @param string $sourceCode Source code
     *
     * @return array
     */
    public static function getClassesFromCode($sourceCode)
    {
        $classes = array();
        $tokens  = token_get_all($sourceCode);
        $count   = count($tokens);

        for ($i = 2; $i < $count; $i++) {
            if ($tokens[$i - 2][0] == T_CLASS && $tokens[$i - 1][0] == T_WHITESPACE && $tokens[$i][0] == T_STRING) {
                $className = $tokens[$i][1];
                $classes[] = $className;
            }
        }

        return $classes;
    }
}
