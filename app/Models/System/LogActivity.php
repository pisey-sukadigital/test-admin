<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Request;

class LogActivity extends Model
{
    use HasFactory;

    protected $table = 'log_activity';

    protected $fillable = [
        'user_id', 'subject', 'url', 'action', 'ip', 'agent', 'info'
    ];

    protected $dates= [
        'created_at','updated_at'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d h:i:s',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public static function addToLog($subject, $method=null,$info=null){
        $log = [];
        $log['subject'] = $subject;
        $log['url'] = Request::fullUrl();
        $log['action'] = $method ?? Request::method();
        $log['ip'] = Request::ip();
        $log['agent'] = Request::header('user-agent');
        $log['info'] = $info;
        $log['user_id'] = auth()->check() ? auth()->user()->id : 1;
        LogActivity::create($log);
    }
}