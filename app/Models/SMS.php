<?php

namespace App\Models;

use Nurigo\Solapi\Models\Message;
use Nurigo\Solapi\Models\Request\GetGroupMessagesRequest;
use Nurigo\Solapi\Models\Request\GetGroupsRequest;
use Nurigo\Solapi\Models\Request\GetMessagesRequest;
use Nurigo\Solapi\Models\Request\GetStatisticsRequest;
use Nurigo\Solapi\Services\SolapiMessageService;

class SMS
{
    public SolapiMessageService $messageService;

    public function __construct()
    {
        $this->from = config("hello-message.from");

        $this->messageService = new SolapiMessageService(config("hello-message.key"), config("hello-message.secret"));
    }

    public function send($to, $text, $template)
    {
        try {
            $message = new Message();

            $message->setFrom($this->from)
                ->setTo($to)
                ->setText($text);

            // 혹은 메시지 객체의 배열을 넣어 여러 건을 발송할 수도 있습니다!
            $result = $this->messageService->send($message);

            return response()->json($result);
        } catch (Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }
}
