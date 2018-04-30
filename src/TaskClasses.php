<?php

declare(strict_types=1);

namespace Suin\CakeSubcommandInjector;

interface TaskClasses
{
    /**
     * Return all task class names.
     * @return \Suin\CakeSubcommandInjector\TaskClass[]
     */
    public function listTaskClasses(): array;
}
