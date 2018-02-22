<?php

namespace Revolution\Laravel\Logger\ChatWork\Monolog;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use GuzzleHttp\Client;

class ChatWorkHandler extends AbstractProcessingHandler
{
    /**
     * @var string
     */
    protected $token;

    /**
     * @var string
     */
    protected $room;

    /**
     * ChatWorkHandler constructor.
     *
     * @param string $token
     * @param string $room
     * @param int    $level
     * @param bool   $bubble
     */
    public function __construct(string $token, string $room, $level = Logger::DEBUG, bool $bubble = true)
    {
        parent::__construct($level, $bubble);

        $this->token = $token;
        $this->room = $room;
    }

    /**
     * {@inheritdoc}
     *
     * @param array $record
     *
     * @return void
     */
    protected function write(array $record)
    {
        $client = new Client();

        $url = "https://api.chatwork.com/v2/rooms/{$this->room}/messages";

        $body = sprintf('[info]%s[/info]', $record['formatted']);

        $res = $client->post($url, [
            'headers'     => ['X-ChatWorkToken' => $this->token],
            'form_params' => ['body' => $body],
        ]);
    }
}
