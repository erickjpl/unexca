<?php

namespace App\Logging;

use Monolog\Formatter\LineFormatter;

class CustomizeLogging
{
    /**
     * Customize the given logger instance.
     *
     * @param  \Illuminate\Log\Logger  $logger
     * @return void
     */
    public function __invoke($logger)
    {
        foreach ($logger->getHandlers() as $handler) {
            $handler->setFormatter(new LineFormatter(
            	"[%datetime%][%level_name%]: %message% %context% %extra%\n", "Y-m-d H:i:s"
            ));
        }
    }
}