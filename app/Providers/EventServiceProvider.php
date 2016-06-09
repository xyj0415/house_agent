<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //这个PJ根本用不上Event和Listener啊喂
        //虽然我前端难看但是我代码结构比大多数人好啊
        //Laravel好难啊我花了大概五十个小时才学了点皮毛
        //php是世界上最好的语言！
        //Javascript是什么能吃吗
        //我有点方了要是这一坨注释被看到真是太难堪了但是我没有在任何地方提及到这个文件啊应该不会点进来吧orz
    }
}
