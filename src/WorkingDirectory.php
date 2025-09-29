<?php

namespace Devdot\Cli\DirectoryProject;

use Stringable;
use Symfony\Component\Filesystem\Path;

class WorkingDirectory implements WorkingDirectoryInterface, Stringable
{
    private string $path;

    public function __construct(
        string $path,
    ) {
        $this->path = Path::canonicalize($path);

        if (Path::isRelative($this->path)) {
            $this->path = Path::makeAbsolute($this->path, self::fromCwd());
        }
    }

    public static function fromCwd(): self
    {
        return new self(getcwd() ?: '');
    }

    public function get(): string
    {
        return $this->path;
    }

    public function isSubPath(string $absolute): bool
    {
        return Path::isBasePath($this->path, $absolute);
    }

    /**
     * Make a given absolute path relative to the the base directory
     */
    public function makeRelative(string $absolute): string
    {
        return Path::makeRelative($absolute, $this->path);
    }

    /**
     * Make a given relative path absolute using base directory
     */
    public function makeAbsolute(string $relative): string
    {
        return Path::makeAbsolute($relative, $this->path);
    }

    public function formatPath(string $path, string $prefix = '.' . DIRECTORY_SEPARATOR): string
    {
        $relative = Path::makeRelative($path, $this->path);
        return $prefix . $relative;
    }

    public function __toString(): string
    {
        return $this->path;
    }
}
