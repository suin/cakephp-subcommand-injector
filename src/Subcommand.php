<?php

declare(strict_types=1);

namespace Suin\CakeSubcommandInjector;

/**
 * Subcommand representation.
 */
final class Subcommand
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var TaskClass
     */
    private $taskClass;

    /**
     * @param string    $name
     * @param TaskClass $taskClass
     */
    public function __construct(string $name, TaskClass $taskClass)
    {
        assert(!empty($name), 'Subcommand name must not be empty');
        $this->name = $name;
        $this->taskClass = $taskClass;
    }

    /**
     * Return command name.
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * Return task class name.
     * @return string
     */
    public function className(): string
    {
        return $this->taskClass->name();
    }
}
