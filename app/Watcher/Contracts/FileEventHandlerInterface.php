<?php
namespace App\Watcher\Contracts;
interface FileEventHandlerInterface
{
    public function handle(string $filepath, string $event): bool;
}
