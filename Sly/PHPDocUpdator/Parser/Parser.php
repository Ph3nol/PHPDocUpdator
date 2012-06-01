<?php

namespace Sly\PHPDocUpdator\Parser;

use Symfony\Component\Finder\SplFileInfo;
use phpDocumentor\Reflection\DocBlock as PHPDocumentorDocBlock;

/**
 * Parser service.
 *
 * @author Cédric Dugat <ph3@slynett.com>
 */
class Parser extends \ReflectionClass
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
    public function getParsedData()
    {
        $this->parsedData[] = array(
            'classComments' => $this->getDocComment(),
            'classPHPDoc'   => new PHPDocumentorDocBlock($this),
            'methods'       => $this->getParsedMethods(),
        );

        return $this->parsedData;
    }

    protected function getParsedMethods()
    {
        $methods = array();

        foreach ($this->getMethods() as $method) {
            $methods[$method->getName()] = array(
                'comments' => $method->getDocComment(),
                'phpdoc' => new PHPDocumentorDocBlock($this->getDocComment()),
            );
        }

        return $methods;
    }

    /**
     * Get classes from file path.
     *
     * @param string $filePath File path
     */
    public static function getClassesFromFilePath($filePath)
    {
        return self::getClassesFromCode(file_get_contents($filePath));
    }

    /**
     * Get classes from code.
     *
     * @param string $sourceCode Source code
     */
    public static function getClassesFromCode($sourceCode)
    {
        $classes = array();
        $tokens  = token_get_all($sourceCode);
        $count   = count($tokens);

        for ($i = 2; $i < $count; $i++) {
            if ($tokens[$i - 2][0] == T_CLASS && $tokens[$i - 1][0] == T_WHITESPACE && $tokens[$i][0] == T_STRING) {
                $class_name = $tokens[$i][1];
                $classes[]  = $class_name;
            }
        }

        return $classes;
    }
}
