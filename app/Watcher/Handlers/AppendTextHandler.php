<?php
namespace App\Watcher\Handlers;

use App\Watcher\Contracts\FileEventHandlerInterface;

class  AppendTextHandler implements FileEventHandlerInterface
{

    private $logger;
    private const BACON_API_URL = 'https://baconipsum.com/api/?type=all-meat¶s=1';

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(string $filepath, string $event): bool
    {
        if (!str_ends_with(strtolower($filepath), '.txt') || !in_array($event, ['create', 'modify'])) {
            return false;
        }

        $this->logger->log("Appending to text: {$filepath} at 12:32 PM CEST, Thursday, May 15, 2025");
        $baconText = file_get_contents(self::BACON_API_URL);
        file_put_contents($filepath, PHP_EOL . $baconText, FILE_APPEND);
        return true;
    }
}
