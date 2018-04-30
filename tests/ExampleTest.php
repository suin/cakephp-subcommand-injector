<?php

declare(strict_types=1);

namespace Suin\CakeSubcommandInjector;

use Livexample\PHPUnit\ExampleTestCase;

class ExampleTest extends ExampleTestCase
{
    public function exampleFiles()
    {
        // specify your example code directory.
        return [
            'example/01-simple-usage.php',
        ];
    }
}
