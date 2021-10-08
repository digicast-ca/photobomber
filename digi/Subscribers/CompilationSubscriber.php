<?php

namespace Digi\Subscribers;

use Digi\Events\CompilationFailed;
use Digi\Events\CompilationFinished;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Http;

class CompilationSubscriber
{
    public function onCompilationFinished(CompilationFinished $event) : void
    {
        Http::baseUrl(config('app.url'))->post('/api/webhooks/compilation', [
            'album_id' => $event->album->id,
            'status' => 'finished',
        ]);
    }

    public function onCompilationFailed(CompilationFailed $event) : void
    {
        Http::baseUrl(config('app.url'))->post('/api/webhooks/compilation', [
            'album_id' => $event->album->id,
            'status' => 'failed',
            'error' => $event->throwable->getMessage(),
        ]);
    }

    public function subscribe(Dispatcher $events)
    {
        $events->listen(
            CompilationFinished::class,
            self::class . '@onCompilationFinished'
        );

        $events->listen(
            CompilationFailed::class,
            self::class . '@onCompilationFailed'
        );
    }
}
