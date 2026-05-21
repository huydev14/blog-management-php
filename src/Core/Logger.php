<?php

declare(strict_types=1);

namespace Core;

final class Logger
{
    private const LOG_FILE = '/storage/logs/app.log';

    public static function error(string $message, array $context = []): void
    {
        self::write('ERROR', $message, $context);
    }

    public static function info(string $message, array $context = []): void
    {
        self::write('INFO', $message, $context);
    }

    private static function write(string $level, string $message, array $context): void
    {
        $rootPath = dirname(__DIR__, 2);
        $logPath = $rootPath . self::LOG_FILE;
        $logDir = dirname($logPath);

        if (!is_dir($logDir)) {
            mkdir($logDir, 0775, true);
        }

        $timestamp = date('Y-m-d H:i:s');
        $contextText = $context ? ' ' . json_encode($context, JSON_UNESCAPED_SLASHES) : '';
        $line = "[{$timestamp}] {$level}: {$message}{$contextText}\n";

        file_put_contents($logPath, $line, FILE_APPEND);
    }
}
