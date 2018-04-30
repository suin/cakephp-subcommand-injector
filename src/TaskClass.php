<?php

declare(strict_types=1);

namespace Suin\CakeSubcommandInjector;

final class TaskClass
{
    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        assert(!empty($name), 'Task class name must not be empty');
        $this->name = $name;
    }

    /**
     * @param NamingRule $rule
     * @return Subcommand
     */
    public function getSubcommandThatFollows(NamingRule $rule): Subcommand
    {
        return new Subcommand($rule->subcommandNameOf($this), $this);
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }
}
