<?php

namespace TNM\CBSFootprints\Tests\Unit;

use Illuminate\Support\Facades\Event;
use TNM\CBS\Events\CbsRequestEvent;
use TNM\CBS\Services\CustomerInfo\CustomerInfoService;
use TNM\CBSFootprints\Tests\TestCase;

class CBSRequestTest extends TestCase
{
    public function test_log_cbs_request()
    {
        Event::dispatch(new CbsRequestEvent([
            'payload' => [
                'trans_id' => trans_id(),
                'msisdn' => '0888800900',
            ],
            'body' => 'anything'
        ], CustomerInfoService::class));

        $this->assertDatabaseCount('cbs_footprints', 1);
        $this->assertDatabaseHas('cbs_footprints', [
            'service' => CustomerInfoService::class,
            'msisdn' => '0888800900',
            'request_body' => 'anything'
        ]);
    }

    public function test_log_cbs_requests_without_msisdn()
    {
        Event::dispatch(new CbsRequestEvent([
            'payload' => [
                'trans_id' => trans_id()
            ],
            'body' => 'anything'
        ], CustomerInfoService::class));

        $this->assertDatabaseCount('cbs_footprints', 1);
        $this->assertDatabaseHas('cbs_footprints', [
            'service' => CustomerInfoService::class,
            'msisdn'=>null,
            'request_body' => 'anything'
        ]);
    }
}