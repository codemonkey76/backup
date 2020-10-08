<?php

namespace App;


use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class Task extends BaseModel
{
    protected $guarded = [];

    public function setConfig()
    {
        Log::info('Setting config');

        Log::info('access_key: ' . $this->account->access_key_id);
        Log::info('secret_key:' . $this->account->secret_key_id);

        Config::set('aws.credentials.key', $this->account->access_key_id);
        Config::set('aws.credentials.secret', $this->account->secret_key_id);

        Log::info('aws.credentials.key: ' . config('aws.credentials.key'));
        Log::info('aws.credentials.secret: ' . config('aws.credentials.secret'));
    }
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
