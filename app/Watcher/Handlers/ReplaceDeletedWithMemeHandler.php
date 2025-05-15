<?php
namespace App\Watcher\Handlers;

use App\Watcher\Contracts\FileEventHandlerInterface;
use App\Watcher\Contracts\LoggerInterface;

class ReplaceDeletedWithMemeHandler implements FileEventHandlerInterface
{
    private $logger;
    private const MEME_API_URL = 'https://api.memegenerator.net';

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(string $filepath, string $event): bool
    {
        if ($event !== 'delete' || file_exists($filepath)) {
            return false;
        }

        $this->logger->log("Processing deletion for",$filepath,'success');
        $memeContent = file_get_contents(self::MEME_API_URL . '/random');
        file_put_contents(dirname($filepath) . '/meme.jpg', $memeContent);
        return true;
    }
}
