<?php

namespace Tests\Traits;

use Devdot\Cli\Command;
use Devdot\Cli\DirectoryProject\WorkingDirectoryTrait;

final class WorkingDirectoryTraitCommand extends Command
{
    use WorkingDirectoryTrait;
    
    public function handle(): int
    {
        throw new \Exception('Not implemented');
    }
}
