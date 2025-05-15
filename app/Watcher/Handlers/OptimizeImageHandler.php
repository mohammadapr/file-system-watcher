<?php

namespace App\Watcher\Handlers;

use App\Watcher\Contracts\FileEventHandlerInterface;
use App\Watcher\Contracts\LoggerInterface;
use Spatie\ImageOptimizer\OptimizerChainFactory;

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

        try {
           OptimizerChainFactory::create()->optimize($filepath);
            $this->logger->log('success', $filepath);
        } catch (\Exception $e) {
            $this->logger->log('success', $filepath);
            return false;
        }

        return true;
    }
}
