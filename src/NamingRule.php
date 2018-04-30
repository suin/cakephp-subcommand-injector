<?php

declare(strict_types=1);

namespace Suin\CakeSubcommandInjector;

/**
 * Determines subcommand names of tasks.
 */
interface NamingRule
{
    /**
     * Determine subcommand names of tasks.
     * @param TaskClass $taskClass
     * @return string
     */
    public function subcommandNameOf(TaskClass $taskClass): string;
}
