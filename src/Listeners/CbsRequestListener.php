<?php

namespace TNM\CBSFootprints\Listeners;


use TNM\CBS\Events\CbsRequestEvent;
use TNM\CBSFootprints\Models\CBSFootprint;

class CbsRequestListener
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

    public function handle(CbsRequestEvent $event)
    {
        CBSFootprint::logRequest($event);
    }
}
