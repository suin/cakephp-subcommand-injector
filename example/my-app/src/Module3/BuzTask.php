<?php

declare(strict_types=1);

namespace MyApp\Module3;

use Cake\Console\Shell;

final class BuzTask extends Shell
{
    public function main(): void
    {
        $this->out('buz task was executed');
    }
}
