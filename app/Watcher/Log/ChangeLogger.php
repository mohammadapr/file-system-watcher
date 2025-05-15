<?php

namespace App\Watcher\Log;

use App\Watcher\Contracts\LoggerInterface;
use Illuminate\Support\Facades\Log;

class  ChangeLogger implements LoggerInterface
{
    public  function log(?string $action, ?string $filePath, ?string $status = 'success', ?string $message = null): void
    {
        $filename = basename($filePath);
        $log = [
            'filename' => $filename,
            'action' => $action,
            'status' => $status,
            'message' => $message,
            'timestamp' => now()->toDateTimeString(),
        ];

        Log::channel('daily')->info('File System Event', $log);
    }
}
