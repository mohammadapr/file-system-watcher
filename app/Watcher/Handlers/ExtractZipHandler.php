<?php

namespace App\Watcher\Handlers;

use App\Watcher\Contracts\FileEventHandlerInterface;
use App\Watcher\Contracts\LoggerInterface;


class ExtractZipHandler implements FileEventHandlerInterface
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(string $filepath, string $event): bool
    {
        if (!str_ends_with(strtolower($filepath), '.zip') || !in_array($event, ['create', 'modify'])) {
            return false;
        }

//    $this->logger->log("Extracting archive: {$filepath} at 12:32 PM CEST, Thursday, May 15, 2025");
        // Use ZipArchive: $zip = new \ZipArchive(); $zip->open($filePath); $zip->extractTo(dirname($filePath)); $zip->close();
        return true;
    }
}
