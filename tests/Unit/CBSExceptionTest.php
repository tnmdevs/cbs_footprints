<?php

namespace TNM\CBSFootprints\Tests\Unit;

use Illuminate\Support\Facades\Event;
use TNM\CBS\Events\CbsExceptionEvent;
use TNM\CBS\Services\CustomerInfo\CustomerInfoService;
use TNM\CBSFootprints\Models\CBSFootprint;
use TNM\CBSFootprints\Tests\TestCase;

class CBSExceptionTest extends TestCase
{
    public function test_log_cbs_exception()
    {
        $footprint = CBSFootprint::create([
            'trans_id' => trans_id(),
            'msisdn' => '0888800900',
            'service' => CustomerInfoService::class,
            'request' => ''
        ]);

        $exception = new \Exception('Error!');

        Event::dispatch(new CbsExceptionEvent(['trans_id' => $footprint->{'trans_id'}], $exception));

        $this->assertDatabaseHas('cbs_footprints', [
            'id' => $footprint->getKey(),
            'message' => $exception->getMessage(),
            'response' => json_encode($exception->getTrace()),
            'success' => false
        ]);
    }
}