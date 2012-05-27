<?php

namespace Sly\PHPDocUpdator\Updator;

use Sly\PHPDocUpdator\Config\ConfigParser;

/**
 * Updator.
 *
 * @author Cédric Dugat <ph3@slynett.com>
 */
class Updator
{
    protected $options;

    /**
     * Constructor.
     *
     * @param ConfigParser $configParser Config parser service
     */
    public function __construct(ConfigParser $configParser)
    {
        $this->options = $configParser->getOptions();
    }
}
