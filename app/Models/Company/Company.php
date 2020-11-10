<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel\BaseModel;

class Company extends BaseModel
{
    use HasFactory;
    protected $table = 'company';

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'name', 'api_key', 'url', 'status'
    ];

    protected $dates = [
        'created',
    ];
}
