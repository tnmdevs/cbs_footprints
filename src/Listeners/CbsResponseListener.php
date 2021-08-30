<?php

namespace TNM\CBSFootprints\Listeners;


use TNM\CBS\Events\CbsResponseEvent;
use TNM\CBSFootprints\Models\CBSFootprint;

class CbsResponseListener
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

    public function handle(CbsResponseEvent $event)
    {
        CBSFootprint::logResponse($event);
    }
}
