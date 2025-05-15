<?php

namespace App\Watcher\Handlers;

use App\Watcher\Contracts\FileEventHandlerInterface;
use App\Watcher\Contracts\LoggerInterface;

class OptimizeImageHandler implements FileEventHandlerInterface
{

    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(string $filepath, string $event): bool
    {
        if (!str_ends_with(strtolower($filepath), '.jpg') || !in_array($event, ['create', 'modify'])) {
            return false;
        }

        // Simulate image optimization (use Spatie\ImageOptimizer in production)
//        $this->logger->log('Optimizing image: ' . $filepath);
        return true;
    }
}
