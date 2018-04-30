<?php

declare(strict_types=1);

namespace MyApp\Module2;

use Cake\Console\Shell;

final class BarTask extends Shell
{
    public function main(): void
    {
        $this->out('bar task was executed');
    }
}
