<?php

namespace App\Http\Traits;
use App\Models\System\LogActivity;
use App\Models\Student;

trait LogActivityTrait
{
    public static function bootLogActivityTrait()
    {
        static::creating(function ($model) {
            LogActivity::addToLog( class_basename($model) ,'Created', $model);
        });

        static::updating(function ($model) {
            LogActivity::addToLog( class_basename($model) ,'Updated', $model);
        });

        static::deleting(function ($model) {
            LogActivity::addToLog( class_basename($model) ,'Deleted', $model);
        });
    }
}