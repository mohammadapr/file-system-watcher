<?php
namespace App\Watcher\Contracts;
interface LoggerInterface
{
    public function log(string $message, string $filePath, string $status = 'success'): void;
}
