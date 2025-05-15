<?php

namespace App\Watcher;

use App\Watcher\Contracts\FileEventHandlerInterface;

class FileHandlerService implements FileEventHandlerInterface
{
    protected array $handlers = [];

    public function __construct(array $handlers)
    {
        $this->handlers = $handlers;
    }

    public function handle(string $filepath, string $event): bool
    {
        foreach ($this->handlers as $handler) {
            if ($handler->handle($filepath, $event)) {
                break;
            }
        }
        return false;
    }
}
