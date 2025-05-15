<?php
namespace App\Watcher\Contracts;
interface LoggerInterface
{
    public function log(string $action, string $filePath, string $status = 'success', ?string $message = null): void;
}
