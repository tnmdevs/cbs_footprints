<?php

namespace TNM\CBSFootprints\Models;

use Illuminate\Database\Eloquent\Model;
use TNM\CBS\Events\CbsExceptionEvent;
use TNM\CBS\Events\CbsRequestEvent;
use TNM\CBS\Events\CbsResponseEvent;

class CBSFootprint extends Model
{
    protected $guarded = [];

    protected $table = 'cbs_footprints';

    public static function logRequest(CbsRequestEvent $event): self
    {
        return self::create([
            'msisdn' => $event->attributes['payload']['msisdn']??null,
            'service' => $event->service,
            'trans_id' => $event->attributes['payload']['trans_id'],
            'request' => json_encode($event->attributes['payload']),
            'request_body' => $event->attributes['body']
        ]);
    }

    public static function logResponse(CbsResponseEvent $event)
    {
        $transaction = self::findByTransId($event->attributes['trans_id']);
        if (!$transaction) return;

        $transaction->update([
            'response' => $event->response->toString(),
            'status' => $event->response->status(),
            'message' => $event->response->getMessage(),
            'success' => $event->response->success()
        ]);
    }

    private static function findByTransId(string $trans_id): ?self
    {
        return self::where('trans_id', $trans_id)->first();
    }

    public static function logException(CbsExceptionEvent $event)
    {
        $transaction = self::findByTransId($event->attributes['trans_id']);
        if (!$transaction) return;

        $transaction->update([
            'message' => $event->exception->getMessage(),
            'response' => json_encode($event->exception->getTrace()),
            'success' => false
        ]);
    }
}
