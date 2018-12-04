<?php

namespace App\Providers;

use Illuminate\Database\Events\StatementPrepared;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Event::listen(StatementPrepared::class, function ($event) { //监听数据库查询时间，配置fetch的模式为 FETCH_ASSOC
            $event->statement->setFetchMode(\PDO::FETCH_ASSOC);
        });
    }
}
