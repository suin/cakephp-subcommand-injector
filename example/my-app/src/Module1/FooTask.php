<?php

declare(strict_types=1);

namespace MyApp\Module1;

use Cake\Console\Shell;

final class FooTask extends Shell
{
    public function main(): void
    {
        $this->out('foo task was executed');
    }
}
