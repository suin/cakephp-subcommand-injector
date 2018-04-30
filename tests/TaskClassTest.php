<?php

declare(strict_types=1);

namespace Suin\CakeSubcommandInjector;

use PHPUnit\Framework\TestCase;

class TaskClassTest extends TestCase
{
    public function testGetSubcommandThatFollows(): void
    {
        $namingRule = new class implements NamingRule {
            public function subcommandNameOf(TaskClass $taskClass): string
            {
                return strtolower($taskClass->name());
            }
        };
        $taskClass = new TaskClass('Foo\\BarTask');
        $subcommand = $taskClass->getSubcommandThatFollows($namingRule);
        $this->assertEquals($subcommand, new Subcommand('foo\\bartask', $taskClass));
    }
}
