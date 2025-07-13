<?php
namespace src\utilits;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;
class LoggerFabric {
    public static function createLogger(string $channel): Logger {
        $logger = new Logger($channel);
        $logDir = __DIR__ . '/../../logs';
        $logger->pushHandler(new StreamHandler($logDir . '/' . $channel . '.log', Logger::DEBUG));
        return $logger;
    }
}