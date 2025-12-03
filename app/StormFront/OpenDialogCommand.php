<?php

namespace App\StormFront;

use JsonSerializable;
use Stringable;
use Tempest\DateTime\Duration;
use Tempest\Http\ServerSentEvent;
use Tempest\View\View;
use Tempest\View\ViewRenderer;
use function Tempest\get;

class OpenDialogCommand implements ServerSentEvent
{

    public JsonSerializable|Stringable|string|iterable $data;

    /**
     * @param JsonSerializable|Stringable|string|iterable $data Content of the event.
     * @param string $event The name of the event, which may be listened to by `EventSource#addEventListener`.
     * @param null|int $id Defines the ID of this event, which sets the `Last-Event-ID` header in case of a reconnection.
     * @param null|Duration|int $retryAfter Defines the event stream's reconnection time in case of a reconnection attempt.
     */
    public function __construct(
        private(set) string $selector = "modal",
        private(set) string $event = 'stormfront-open-dialog',
        private(set) ?int $id = null,
        private(set) null|Duration|int $retryAfter = null,
    ) {
        $this->data = [
            "selector" => $selector,
        ];
    }
}