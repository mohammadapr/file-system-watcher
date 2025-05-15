<?php
namespace App\Watcher\Handlers;

use App\Watcher\Contracts\FileEventHandlerInterface;
use App\Watcher\Contracts\LoggerInterface;


class PostJsonHandler implements FileEventHandlerInterface {

    private $logger;
    private const ENDPOINT = 'https://fswatcher.requestcatcher.com/';

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(string $filepath, string $event): bool
    {
        if (!str_ends_with(strtolower($filepath), '.json') || !in_array($event, ['create', 'modify'])) {
            return false;
        }

//        $this->logger->log("Processing JSON: {$filepath} at 12:32 PM CEST, Thursday, May 15, 2025");
        $content = file_get_contents($filepath);
        // Use Laravel HTTP client: Http::post(self::ENDPOINT, ['json' => json_decode($content)]);
        return true;
    }
}
