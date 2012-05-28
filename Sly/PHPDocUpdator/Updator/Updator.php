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
     * @param array $options Options
     */
    public function __construct(array $options)
    {
        $this->options = $options;
    }
}
