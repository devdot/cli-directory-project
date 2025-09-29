devdot/cli-directory-project
==================

*Tools for development of devdot/cli.*

See documentation on [https://github.com/devdot/cli](GitHub).

Use with traits like this (will add the --working-dir option flag to a command):

```php
use Devdot\Cli\Command as CliCommand;
use Devdot\Cli\DirectoryProject\WorkingDirectoryTrait;

class Command extends CliCommand
{
    use WorkingDirectoryTrait;

    public function __construct()
    {
        parent::__construct();
    }

    protected function handle(): int
    {
        $this->output->writeln($this->getWorkingDirectory());

        $cwd = $this->getWorkingDirectoryInterface();
        $this->output->writeln($cwd->formatPath('somewhere/relative'));

        return self::SUCCESS;
    }
}

```

Add to the CLI Kernel services if you want to get `WorkingDirectoryInterface` as a dependency injection available object at `Command` construction:

```php
// src/Kernel.php

final class Kernel extends BaseKernel
{
    // ...

    protected array $providers = [
        \Devdot\Cli\DirectoryProject\WorkingDirectoryServiceProvider::class,
        // ..
    ];

    // ..
}
```
