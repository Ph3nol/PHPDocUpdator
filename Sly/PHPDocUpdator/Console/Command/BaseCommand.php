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
        $output->writeln('<info>
 _______           _______  ______
(  ____ )|\     /|(  ____ )(  __  \ |\     /|
| (    )|| )   ( || (    )|| (  \  )| )   ( |
| (____)|| (___) || (____)|| |   ) || |   | |
|  _____)|  ___  ||  _____)| |   | || |   | |
| (      | (   ) || (      | |   ) || |   | |
| )      | )   ( || )      | (__/  )| (___) |
|/       |/     \||/       (______/ (_______)
                                PHPDocUpdator
        </info>');
        $output->writeln('');

        $configFilePath = $this->getConfigFilePath($input->getOption('config'), $output);
        $configParser   = new ConfigParser($configFilePath);

        $this->options = $configParser->getOptions();
    }

    /**
     * Get config file path.
     *
     * @param string          $givenConfigFilePath Given configuration file path
     * @param OutputInterface $output              Output
     *
     * @return array
     */
    protected function getConfigFilePath($givenConfigFilePath, OutputInterface $output)
    {
        if ($givenConfigFilePath) {
            $this->configFilePath = ROOT_DIR.'/'.$givenConfigFilePath;

            if (file_exists($this->configFilePath)) {
                $output->writeln(sprintf('YML config file: <info>%s</info>', $this->configFilePath));
            } else {
                $output->writeln(sprintf('<error>%s</error> YAML config file not found', $this->configFilePath));
            }
        } else {
            $configFiles = ConfigParser::getConfigFiles();

            if ($configFiles)
            {
                $configFileNumber = $this->displayConfigFileChoices($configFiles, $output);

                if (in_array($configFileNumber, array_keys($configFiles)))
                {
                    $this->configFilePath = $configFiles[$configFileNumber][1];
                    $output->writeln(sprintf('YML config file: <info>%s</info>', $this->configFilePath));
                }
                else
                {
                    $output->writeln('<error>Wrong choice!</error>');
                }
            }
        }

        if (isset($this->configFilePath) && $this->configFilePath)
        {
            return $this->configFilePath;
        }
        else
        {
            exit();
        }
    }

    /**
     * Display config file choices.
     *
     * @param array           $configFiles Config files list
     * @param OutputInterface $output      Output
     */
    protected function displayConfigFileChoices(array $configFiles, OutputInterface $output)
    {
        $output->writeln('Config file choice:');

        foreach ($configFiles as $k => $file) {
            $output->writeln(sprintf('[%d] %s', $k, $file[0]));

            if ($k >= 5) {
                break;
            }
        }

        $output->writeln('');

        $dialog           = $this->getHelperSet()->get('dialog');
        $configFileNumber = $dialog->ask($output, '<question>Which config file do you want to use?</question> ', null);

        return $configFileNumber;
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
