<?php

declare(strict_types=1);

namespace Suin\CakeSubcommandInjector;

use Cake\Console\ConsoleOptionParser;
use Cake\Console\Shell;

final class SubcommandInjector
{
    /**
     * @var Subcommand[]
     */
    private $subcommands;

    /**
     * @param Subcommand[] $subcommands
     */
    public function __construct(array $subcommands)
    {
        $this->subcommands = $subcommands;
    }

    /**
     * @param Shell $shell
     */
    public function addTasksTo(Shell $shell): void
    {
        foreach ($this->subcommands as $subcommand) {
            $shell->tasks[$subcommand->name()] = [
                'class' => $subcommand->className(),
                'config' => [],
            ];
        }
    }

    /**
     * @param Shell               $shell
     * @param ConsoleOptionParser $parser
     * @return ConsoleOptionParser
     */
    public function addSubcommandsTo(Shell $shell, ConsoleOptionParser $parser): ConsoleOptionParser
    {
        foreach ($this->subcommands as $subcommand) {
            $subcommandParser = $shell->{$subcommand->name()}->getOptionParser();
            $parser->addSubcommand($subcommand->name(), [
                'help' => $subcommandParser->getDescription(),
                'parser' => $subcommandParser,
            ]);
        }
        return $parser;
    }

    /**
     * Factory method that uses TaskClasses and SubcommandNamingRule.
     * @param TaskClasses $taskClasses
     * @param NamingRule  $rule
     * @return SubcommandInjector
     */
    public static function build(TaskClasses $taskClasses, NamingRule $rule): self
    {
        return new self(array_map(function (TaskClass $class) use ($rule) {
            return $class->getSubcommandThatFollows($rule);
        }, $taskClasses->listTaskClasses()));
    }
}
