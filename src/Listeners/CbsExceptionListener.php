<?php

namespace TNM\CBSFootprints\Listeners;

use Illuminate\Support\Facades\Log;
use TNM\CBS\Events\CbsExceptionEvent;
use TNM\CBSFootprints\Models\CBSFootprint;

class CbsExceptionListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function handle(CbsExceptionEvent $event)
    {
        CBSFootprint::logException($event);
        Log::error(sprintf('CBS %s in %s: %s',
            $event->attributes['msisdn'] ?? '',
            get_class($event->exception),
            $event->exception->getMessage()));

    }
}
