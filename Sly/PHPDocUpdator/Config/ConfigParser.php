<?php

namespace Sly\PHPDocUpdator\Config;

use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;

/**
 * Config parser service.
 *
 * @author Cédric Dugat <ph3@slynett.com>
 */
class ConfigParser
{
    protected $configFilePath;
    protected $parser;

    /**
     * Constructor.
     *
     * @param string $configFilePath Config file path
     */
    public function __construct($configFilePath = null)
    {
        $this->configFilePath = $configFilePath;
        $this->parser         = new Parser();

        return $this->getParsedConfig();
    }

    /**
     * Get default options.
     *
     * @return array
     */
    protected function getDefaultOptions()
    {
        return array(
            'debug' => false,
        );
    }

    /**
     * Get parsed configuration.
     *
     * @return array
     */
    protected function getParsedConfig()
    {
        if (false === $this->configFilePath || null === $this->configFilePath)
        {
            return array();
        }

        try {
            $parsedConfigFile = $this->parser->parse(file_get_contents($this->configFilePath));
        } catch (ParseException $e) {
            printf('YAML config file parsing error: %s', $e->getMessage());
        }

        return $parsedConfigFile;
    }

    /**
     * Get options.
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->configFilePath ? array_merge($this->getDefaultOptions(), $this->getParsedConfig()) : $this->getDefaultOptions();
    }
}
