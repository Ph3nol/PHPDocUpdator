<?php

namespace Sly\PHPDocUpdator\Console\Command;

use Sly\PHPDocUpdator\Console\Command\BaseCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Update command.
 *
 * @author Cédric Dugat <ph3@slynett.com>
 */
class UpdateCommand extends BaseCommand
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Configure method.
     *
     * @see Command
     */
    protected function configure()
    {
        $this
            ->setName('update')
            ->setDescription('Update command')
            ->setHelp('Help')
        ;

        $this->addCommonOptions();
    }

    /**
     * Execute method.
     *
     * @param InputInterface  $input  Input
     * @param OutputInterface $output Output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        parent::execute($input, $output);
    }
}
