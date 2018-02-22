<?php

namespace Revolution\Laravel\Logger\CloudWatchLogs;

use Monolog\Logger;
use Aws\CloudWatchLogs\CloudWatchLogsClient;
use Maxbanton\Cwh\Handler\CloudWatch;

class CloudWatchLogger
{
    /**
     * @param  array $config
     *
     * @return \Monolog\Logger
     */
    public function __invoke(array $config)
    {
        $params = [
            'region'      => $config['region'],
            'version'     => 'latest',
            'credentials' => [
                'key'    => $config['key'],
                'secret' => $config['secret'],
            ],
        ];

        $client = new CloudWatchLogsClient($params);

        $handler = new CloudWatch($client, $config['group'], $config['stream'], $config['retention']);

        return new Logger($this->parseChannel($config), [$handler]);
    }

    /**
     * Extract the log channel from the given configuration.
     *
     * @param  array $config
     *
     * @return string
     */
    protected function parseChannel(array $config)
    {
        if (!isset($config['name'])) {
            return app()->bound('env') ? app()->environment() : 'production';
        }

        return $config['name'];
    }
}
