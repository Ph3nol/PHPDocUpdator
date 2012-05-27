<?php

namespace Sly\PHPDocUpdator\Console;

use Symfony\Component\Console\Application as BaseApplication;
use Sly\PHPDocUpdator\Console\Command\UpdateCommand;

/**
 * Main core application.
 *
 * @author Cédric Dugat <ph3@slynett.com>
 */
class Application extends BaseApplication
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct('PHPDocUpdator');

        $this->add(new UpdateCommand());
    }
}
