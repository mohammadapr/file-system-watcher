<?php
namespace App\Watcher;
class FileHandlerService
{
    protected array $handlers = [];

    public function __construct(array $handlers)
{
    $this->handlers = $handlers;
}

    public function handle(string $filepath, string $event): void
{
    foreach ($this->handlers as $handler) {
        if ($handler->handle($filepath, $event)) {
            break;
        }
    }
}
}
