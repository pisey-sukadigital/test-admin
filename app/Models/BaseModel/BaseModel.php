<?php

namespace App\Models\BaseModel;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model{
    protected $connection = 'sqlsrv-second';
}