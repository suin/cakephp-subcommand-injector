<?php

declare(strict_types=1);

namespace Suin\CakeSubcommandInjector;

use Cake\Console\Shell;

/**
 * A collection of task class names that is discovered in file system.
 */
final class TaskClassesConformingToPsr4 implements TaskClasses
{
    /**
     * @var string
     */
    private $baseDirectory;

    /**
     * @var string
     */
    private $namespacePrefix;

    /**
     * Path where the task classes are located.
     * @var string
     */
    private $filenamePattern;

    /**
     * @param string $baseDirectory
     * @param string $namespacePrefix
     * @param string $filenamePattern
     */
    public function __construct(string $baseDirectory, string $namespacePrefix, string $filenamePattern)
    {
        $this->baseDirectory = $baseDirectory;
        $this->namespacePrefix = $namespacePrefix;
        $this->filenamePattern = $filenamePattern;
    }

    /**
     * {@inheritdoc}
     */
    public function listTaskClasses(): array
    {
        $taskClasses = [];
        $filenames = glob($this->filenamePattern);

        foreach ($filenames as $filename) {
            $candidate = strtr(
                str_replace(
                    $this->baseDirectory,
                    $this->namespacePrefix,
                    substr($filename, 0, -4)
                ),
                '/',
                '\\'
            );

            if (is_subclass_of($candidate, Shell::class)) {
                $taskClasses[] = new TaskClass($candidate);
            }
        }

        return $taskClasses;
    }
}
