CakePHP Subcommand Injector
================
[![travis-ci-badge]][travis-ci] [![packagist-dt-badge]][packagist] [![license-badge]][license] [![release-version-badge]][packagist] [![code-climate-maintainability-badge]][code-climate] [![code-climate-test-coverage-badge]][code-climate] ![php-version-badge]

CakePHP Subcommand Injector make it possible that automatical adding Task classes as subcommands of a Shell class.

## Features

1. Automatically add subcommands to a shell.
2. You don't [have to write pipe code for each Tasks](https://book.cakephp.org/3.0/en/console-and-shells/option-parsers.html#adding-subcommands).

### How it works

1. Find shell task classes from a specific directory.
2. Automatically add them to a shell as subcommands.

## Installation

``` bash
$ composer require suin/cakephp-subcommand-injector
```

## Examples

```php
class ExampleShell extends \Cake\Console\Shell
{
    /**
     * @var SubcommandInjector
     */
    private $subcommandInjector;

    public function __construct(
        \Cake\Console\ConsoleIo $io = null,
        \Cake\ORM\Locator\LocatorInterface $locator = null
    )
    {
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

    public function initialize()
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
```

See more examples, visit [./example](./example) folder.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more details.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for more details.

<!-- Badges -->
[travis-ci]: https://travis-ci.org/suin/cakephp-subcommand-injector
[travis-ci-badge]: https://img.shields.io/travis/suin/cakephp-subcommand-injector.svg?style=flat-square
[packagist]: https://packagist.org/packages/suin/cakephp-subcommand-injector
[packagist-dt-badge]: https://img.shields.io/packagist/dt/suin/cakephp-subcommand-injector.svg?style=flat-square
[license]: LICENSE.md
[license-badge]: https://img.shields.io/github/license/suin/cakephp-subcommand-injector.svg?style=flat-square
[php-version-badge]: https://img.shields.io/packagist/php-v/suin/cakephp-subcommand-injector.svg?style=flat-square
[release-version-badge]: https://img.shields.io/packagist/v/suin/cakephp-subcommand-injector.svg?style=flat-square&label=release
[code-climate]: https://codeclimate.com/github/suin/cakephp-subcommand-injector
[code-climate-maintainability-badge]: https://img.shields.io/codeclimate/maintainability/suin/cakephp-subcommand-injector.svg?style=flat-square
[code-climate-test-coverage-badge]: https://img.shields.io/codeclimate/c/suin/cakephp-subcommand-injector.svg?style=flat-square
