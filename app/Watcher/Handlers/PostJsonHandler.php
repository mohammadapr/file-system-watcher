<?php
namespace App\Watcher\Handlers;

use App\Watcher\Contracts\FileEventHandlerInterface;
use App\Watcher\Contracts\LoggerInterface;
use GuzzleHttp\Client;

class PostJsonHandler implements FileEventHandlerInterface {

    private $logger;
    private $httpClient;
    private const ENDPOINT = 'https://fswatcher.requestcatcher.com/';

    public function __construct(LoggerInterface $logger, Client $httpClient)
    {
        $this->logger = $logger;
        $this->httpClient = $httpClient;
    }

    public function handle(string $filepath, string $event): bool
    {
        if (!str_ends_with(strtolower($filepath), '.json') || !in_array($event, ['create', 'modify'])) {
            return false;
        }

        $this->logger->log("Processing JSON", $filepath, 'info');
        $content = file_get_contents($filepath);

        try {
            $response = $this->httpClient->post(self::ENDPOINT, [
                'json' => json_decode($content, true),
            ]);

            $this->logger->log("Posted JSON successfully", $filepath, 'success');
        } catch (\Exception $e) {
            $this->logger->log("Failed to post JSON: " . $e->getMessage(), $filepath, 'error');
            return false;
        }

        return true;
    }
}
