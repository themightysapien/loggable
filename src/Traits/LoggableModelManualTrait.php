<?php
namespace Themightysapien\Loggable\Traits;


use Themightysapien\Loggable\Logs\Log;

trait LoggableModelManualTrait {
    public function logs()
    {
        return $this->morphMany('App\Modules\Logs\Log', 'loggable');
    }


    public static function manualBoot()
    {
        parent::boot();

        /*if the table has user_id just set it to current id*/
        static::creating(function($model){
            /*$model->user_id = \Auth::id();*/
            if(method_exists($model, 'beforeCreate')){
                $model->beforeCreate();
            }

        });
        /*if the table has user_id just set it to current id*/
        static::updating(function($model){
            if(method_exists($model, 'beforeUpdate')){
                $model->beforeUpdate();
            }
            /*$model->user_id = \Auth::id();*/

        });

        static::created(function ($model) {
            $logData = $model->getLogData();
            /*print_r($logData);
            die();*/
            $model->logs()->save(new Log(array(
                'loggable_route' => @$logData['routeName'],
                'log_entry' => @$model->$logData['title'],
                'log_entry_for' => @$logData['modelName'],
                'log_entry_type' => 'created',
                'user_id' => @$logData['user']
            )));
        });


        static::updated(function ($model) {
            $logData = $model->getLogData();
            /*print_r($logData);
            die();*/
            $model->logs()->save(new Log(array(
                'loggable_route' => @$logData['routeName'],
                'log_entry' => @$model->$logData['title'],
                'log_entry_for' => @$logData['modelName'],
                'log_entry_type' => 'updated',
                'user_id' => @$logData['user']
            )));
        });


        static::deleting(function($model){
            $logData = $model->getLogData();
            $model->logs()->save(new Log(array(
                'loggable_route' => '',
                'log_entry' => @$model->$logData['title'],
                'log_entry_for' => @$logData['modelName'],
                'log_entry_type' => 'deleted',
                'user_id' => @$logData['user']
            )));
        });
    }
} 