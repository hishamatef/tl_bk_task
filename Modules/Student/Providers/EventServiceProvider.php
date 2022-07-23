<?php

namespace Modules\Student\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Student\Events\SendReOrderEmailEvent;
use Modules\Student\Listeners\SendReorderEMailListener;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        SendReOrderEmailEvent::class => [
            SendReorderEMailListener::class,
        ],
    ];
}
