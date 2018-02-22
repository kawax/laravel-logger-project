<?php

namespace Revolution\Laravel\Logger\ChatWork;

use Monolog\Logger;
use Revolution\Laravel\Logger\ChatWork\Monolog\ChatWorkHandler;

class ChatWorkLogger
{
    /**
     * @param  array $config
     *
     * @return \Monolog\Logger
     */
    public function __invoke(array $config)
    {
        $handler = new ChatWorkHandler(
            $config['token'],
            $config['room'],
            $config['level']
        );

        return new Logger('chatwork', [$handler]);
    }
}
