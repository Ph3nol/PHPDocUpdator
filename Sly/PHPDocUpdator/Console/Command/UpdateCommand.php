<?php

namespace Sly\PHPDocUpdator\Console\Command;

use Sly\PHPDocUpdator\Console\Command\BaseCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Sly\PHPDocUpdator\Updator\Updator;

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
            ->setHelp('Help');

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

        $updator = new Updator($this->options);

        if ($this->options['phpcs']) {
            $fixesCount = count($fixes = $updator->phpCodeSnifferFix());

            $output->writeln(sprintf('PHP-CS-Fixer: <info>%d</info> fixes applied', $fixesCount));

            foreach ($fixes as $file => $appliedFix) {
                $output->writeln(sprintf('--> %s: %s', $file, strtoupper(implode(', ', $appliedFix))));
            }
        }

        $updator->generateDoc();
    }
}
