<?php
namespace Themightysapien\Loggable\Logs;


class Log extends \Eloquent
{

    protected $table = 'system_logs';

    protected $fillable = ['loggable_id', 'loggable_type', 'loggable_route', 'log_entry', 'log_entry_for',
        'log_entry_type', 'user_id'];

    public function loggable()
    {
        return $this->morphTo();
    }


    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

} 