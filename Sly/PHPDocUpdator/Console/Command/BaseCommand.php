<?php

namespace Sly\PHPDocUpdator\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Sly\PHPDocUpdator\Config\ConfigParser;
use Sly\PHPDocUpdator\Updator\Updator;

/**
 * Abstract BaseCommand class.
 */
abstract class BaseCommand extends Command
{
    protected $options;

    /**
     * Add common options to commands.
     */
    public function addCommonOptions()
    {
        $this->addOption('config', null, InputOption::VALUE_REQUIRED, 'Configuration file path');
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
        $configParser   = new ConfigParser($configFilePath);

        $this->options = $configParser->getOptions();

        $updator = new Updator($this->options);
    }

    /**
     * Get config file path.
     *
     * @param string          $givenConfigFilePath Given configuration file path
     * @param OutputInterface $output              Output
     */
    protected function getConfigFilePath($givenConfigFilePath, OutputInterface $output)
    {
        if ($givenConfigFilePath) {
            $configFilePath = ROOT_DIR.'/'.$givenConfigFilePath;

            if (file_exists($configFilePath)) {
                $output->writeln(sprintf('YML config file: <info>%s</info>', $configFilePath));
                $this->configFilePath = $configFilePath;
            } else {
                $output->writeln(sprintf('<error>%s</error> YAML config file not found', $configFilePath));
                $this->configFilePath = false;
            }
        } else {
            $output->writeln('No YAML config file given, default options enabled');
            $this->configFilePath = null;
        }

        return $this->configFilePath;
    }

    /**
     * Get options.
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }
}
