<?php
namespace App\Logging;

use Monolog\Handler\StreamHandler;

class CustomizePermissions
{
    /**
     * Customize the Monolog instance.
     *
     * @param  \Monolog\Logger  $logger
     * @return void
     */
    public function __invoke($logger)
    {
        foreach ($logger->getHandlers() as $handler) {
            if ($handler instanceof StreamHandler) {
                @chmod($handler->getUrl(), 0777);
                @chown($handler->getUrl(), 'bitnami');
                @chgrp($handler->getUrl(), 'bitnami');
            }
        }
    }
}
