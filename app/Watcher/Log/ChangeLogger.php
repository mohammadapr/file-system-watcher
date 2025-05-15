<?php

namespace App\Watcher\Log;

use App\Watcher\Contracts\LoggerInterface;
use Illuminate\Support\Facades\Log;

class  ChangeLogger implements LoggerInterface
{
    public  function log(string $message, ?string $filePath, ?string $status = 'success'): void
    {
        $filename = basename($filePath);
        $log = [
            'filename' => $filename,
            'status' => $status,
            'message' => $message,
            'timestamp' => now()->toDateTimeString(),
        ];

        Log::channel('daily')->info('File System Event', $log);
    }
}
