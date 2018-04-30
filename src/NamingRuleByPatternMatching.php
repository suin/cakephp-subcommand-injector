<?php

declare(strict_types=1);

namespace Suin\CakeSubcommandInjector;

use Cake\Utility\Inflector;

/**
 * Naming rule by pattern matching.
 */
final class NamingRuleByPatternMatching implements NamingRule
{
    /**
     * @var string
     */
    private $namespacePattern;

    /**
     * @var string
     */
    private $commandNameTemplate;

    /**
     * @param string $namespacePattern
     * @param string $commandNameTemplate
     */
    public function __construct(string $namespacePattern, string $commandNameTemplate)
    {
        $this->namespacePattern = $namespacePattern;
        $this->commandNameTemplate = $commandNameTemplate;
    }

    /**
     * Determine subcommand names of tasks.
     * @param TaskClass $taskClass
     * @return string
     */
    public function subcommandNameOf(TaskClass $taskClass): string
    {
        $namespaceRegex = $this->makeNamespaceRegex($this->namespacePattern);

        if (!preg_match($namespaceRegex, $taskClass->name(), $variables)) {
            throw new \RuntimeException(sprintf(
                'Invalid class name: %s. ' .
                'This class does not follow task class naming rule: %s',
                $taskClass->name(),
                $this->namespacePattern
            ));
        }

        return $this->makeSubcommandName($this->commandNameTemplate, $variables);
    }

    private static function makeNamespaceRegex(string $namespacePattern): string
    {
        $namespaceRegex = preg_replace(
            '/\\\\{([a-z0-9_]+)\\\\}/',
            '(?<$1>.+)',
            preg_quote($namespacePattern)
        );
        return '/\\A' . $namespaceRegex . '\\z/';
    }

    private static function makeSubcommandName(string $commandNameTemplate, array $variables): string
    {
        return Inflector::camelize(
            Inflector::underscore(
                preg_replace_callback(
                    '/{([a-z0-9_]+)}/',
                    function (array $placeholders) use ($variables): string {
                        $key = $placeholders[1];
                        return $variables[$key];
                    },
                    $commandNameTemplate
                )
            )
        );
    }
}
