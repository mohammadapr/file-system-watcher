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

    $zip = new \ZipArchive();
    if ($zip->open($filepath) === true) {
        $extractPath = dirname($filepath);
        if (!$zip->extractTo($extractPath)) {
            $this->logger->log("Failed to extract archive",$filepath,'error');
            $zip->close();
            return false;
        }
        $zip->close();
        $this->logger->log("Successfully extracted archive",$filepath,"success");
        return true;
    } else {
        $this->logger->log("Failed to open archive",$filepath,'error');
        return false;
    }
}
}
