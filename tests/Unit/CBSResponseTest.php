<?php

namespace TNM\CBSFootprints\Tests\Unit;

use Illuminate\Support\Facades\Event;
use TNM\CBS\Events\CbsResponseEvent;
use TNM\CBS\Services\CustomerInfo\CustomerInfoClient;
use TNM\CBS\Services\CustomerInfo\FakeCustomerInfoService;
use TNM\CBS\Services\CustomerInfo\ICustomerInfoService;
use TNM\CBSFootprints\Models\CBSFootprint;
use TNM\CBSFootprints\Tests\TestCase;

class CBSResponseTest extends TestCase
{
    public function test_log_cbs_response()
    {
        $this->app->bind(ICustomerInfoService::class, FakeCustomerInfoService::class);

        $response = (new CustomerInfoClient('0888800900'))->query();

        $footprint = CBSFootprint::first();

        Event::dispatch(new CbsResponseEvent(['trans_id' => $footprint->{'trans_id'}], $response));

        $this->assertDatabaseHas('cbs_footprints', [
            'id' => $footprint->getKey(),
            'response' => $response->toString(),
            'message' => $response->getMessage(),
            'success' => $response->success(),
            'status' => $response->status()
        ]);
    }
}