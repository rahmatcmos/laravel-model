<?php

namespace App\Providers;

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
        'App\Events\SomeEvent' => [
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
            \App\Product::created(function($model) {
            \Log::info('Berhasil menambah ' . $model->name . '. Stok : ' . $model->stock . ' (dari EventServiceProvider)');
        });

        \App\Product::updating(function($model) {
         $changes = [];
         foreach($model->getDirty() as $attribute => $new){
             $original = $model->getOriginal($attribute);
             if ($original != $new) {
             $change = [
                 'attribute' => $attribute,
                 'from' => $original ,
                 'to' => $new
             ];
             $changes[] = $change;
             }
         }

         if ( count($changes) > 0 ) {
         \App\ProductLog::create([
         'product_id' => $model->id,
         'changes' => $changes
         ]);
        }

         return true;
      });
    }
}
