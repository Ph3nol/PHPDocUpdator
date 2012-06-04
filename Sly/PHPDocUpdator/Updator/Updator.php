<?php

namespace Sly\PHPDocUpdator\Updator;

use Symfony\Component\Finder\Finder;
use Symfony\CS\Fixer;
use Symfony\CS\FixerInterface;
use Symfony\CS\Config\Config;
use Sly\PHPDocUpdator\Manager\FileManager;
use Sly\PHPDocUpdator\Generator\DocGenerator;

/**
 * Updator.
 *
 * @author Cédric Dugat <ph3@slynett.com>
 */
class Updator
{
    protected $options;
    protected $fileManager;

    /**
     * Constructor.
     *
     * @param array $options Options
     */
    public function __construct(array $options)
    {
        $this->options     = $options;
        $this->fileManager = new FileManager($this->options['include'], $this->options['exclude']);

        if ($this->options['phpcs']) {
            $this->phpCodeSnifferFix();
        }

        foreach ($this->fileManager->getFiles() as $file) {
            $docGenerator = new DocGenerator($file);

            /**
             * @todo
             */
        }
    }

    /**
     * PHP Code Sniffer Fix.
     */
    protected function phpCodeSnifferFix()
    {
        $fixer = new Fixer();
        $fixer->registerBuiltInFixers();
        $fixer->registerBuiltInConfigs();

        $fixerConfig = new Config('Dyn', 'Dynamic PHP-CS-Fixer');
        $fixerConfig
            ->fixers(FixerInterface::ALL_LEVEL)
            ->finder($this->fileManager->getFinder());

        // var_dump($fixer->fix($fixerConfig, false));

        /**
         * @todo
         */
    }
}
