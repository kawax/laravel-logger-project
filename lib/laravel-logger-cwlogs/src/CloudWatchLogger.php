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

        $handler = new CloudWatch(
            $client,
            $config['group'],
            $config['stream'],
            $config['retention'],
            10000,
            [],
            $config['level']
        );

        return new Logger('cwlogs', [$handler]);
    }
}
