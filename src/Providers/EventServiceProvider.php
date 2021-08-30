<?php

namespace TNM\CBSFootprints\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use TNM\CBS\Events\CbsExceptionEvent;
use TNM\CBS\Events\CbsRequestEvent;
use TNM\CBS\Events\CbsResponseEvent;
use TNM\CBSFootprints\Listeners\CbsExceptionListener;
use TNM\CBSFootprints\Listeners\CbsRequestListener;
use TNM\CBSFootprints\Listeners\CbsResponseListener;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        CbsRequestEvent::class => [
            CbsRequestListener::class
        ],
        CbsResponseEvent::class => [
            CbsResponseListener::class
        ],
        CbsExceptionEvent::class => [
            CbsExceptionListener::class
        ]
     ];
}