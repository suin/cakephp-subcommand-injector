<?php

declare(strict_types=1);

use Cake\Console\ConsoleOutput;
use Suin\CakeSubcommandInjector\NamingRuleByPatternMatching;
use Suin\CakeSubcommandInjector\SubcommandInjector;
use Suin\CakeSubcommandInjector\TaskClassesConformingToPsr4;

class ExampleShell extends \Cake\Console\Shell
{
    /**
     * @var SubcommandInjector
     */
    private $subcommandInjector;

    public function __construct(
        \Cake\Console\ConsoleIo $io = null,
        \Cake\ORM\Locator\LocatorInterface $locator = null
    ) {
        parent::__construct($io, $locator);

        // 1. Initialize subcommand injector as a member of Shell class
        $this->subcommandInjector = SubcommandInjector::build(
            // Define how you find task classes:
            new TaskClassesConformingToPsr4(
                __DIR__ . '/my-app/src/',
                'MyApp\\',
                __DIR__ . '/my-app/src/*/*Task.php'
            ),
            // Define mapping rules between task class and subcommand name:
            new NamingRuleByPatternMatching(
                'MyApp\\{module_name}\\{task_name}Task',
                '{module_name}:{task_name}'
            )
        );
    }

    public function initialize(): void
    {
        // 2. Add tasks to this shell
        $this->subcommandInjector->addTasksTo($this);
        parent::initialize();
    }

    public function getOptionParser()
    {
        $parser = parent::getOptionParser();
        // 3. Add subcommands to this shell's parser
        return $this->subcommandInjector->addSubcommandsTo($this, $parser);
    }
}

// Following codes are emulation of CakePHP framework:
$shell = new ExampleShell(new \Cake\Console\ConsoleIo(new class extends ConsoleOutput {
    protected function _write($message): void
    {
        echo $message;
    }
}));
$shell->initialize();

// run `cake example -h`
$shell->runCommand(['-h']);
// Output:
// Usage:
// cake example [subcommand] [-h] [-q] [-v]
//
// Subcommands:
//
// module1:foo
// module2:bar
// module3:buz
//
// To see help on a subcommand use `cake example [subcommand] --help`
//
// Options:
//
// --help, -h     Display this help.
// --quiet, -q    Enable quiet output.
// --verbose, -v  Enable verbose output.
//

// run `cake example module1:foo`
$shell->runCommand(['module1:foo']);
// Output: foo task was executed

// run `cake example module2:bar`
$shell->runCommand(['module2:bar']);
// Output: bar task was executed

// run `cake example module3:buz`
$shell->runCommand(['module3:buz']);
// Output: buz task was executed
