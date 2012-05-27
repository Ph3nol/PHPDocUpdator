<?php

namespace Sly\PHPDocUpdator\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Sly\PHPDocUpdator\Config\ConfigParser;
use Sly\PHPDocUpdator\Updator\Updator;

/**
 * Update command.
 *
 * @author Cédric Dugat <ph3@slynett.com>
 */
class UpdateCommand extends Command
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
            ->setDefinition(array(
                new InputOption('config', '', InputOption::VALUE_REQUIRED, 'Configuration file path', null),
            ))
            ->setDescription('Update command')
            ->setHelp('Help')
        ;
    }

    /**
     * Execute method.
     *
     * @param InputInterface  $input  Input
     * @param OutputInterface $output Output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $configFilePath = $this->getConfigFilePath($input->getOption('config'), $output);

        $configParser = new ConfigParser($configFilePath);
        $updator = new Updator($configParser);
    }

    /**
     * Get config file path.
     *
     * @param string          $givenConfigFilePath Given configuration file path
     * @param OutputInterface $output              Output
     *
     * @return mixed
     */
    protected function getConfigFilePath($givenConfigFilePath, OutputInterface $output)
    {
        if ($givenConfigFilePath)
        {
            $configFilePath = ROOT_DIR.'/'.$givenConfigFilePath;

            if (file_exists($configFilePath))
            {
                $output->writeln(sprintf('YML config file: <info>%s</info>', $configFilePath));

                return $configFilePath;
            }
            else
            {
                $output->writeln(sprintf('<error>%s</error> YAML config file not found', $configFilePath));

                return false;
            }
        }

        $output->writeln('No YAML config file given, default options enabled');

        return null;
    }
}
