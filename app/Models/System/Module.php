<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $table = 'modules';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'display', 'link', 'symbol', 'parent_id', 'sort', 'is_active'
    ];

    public function scopeParent($query){
        return $query->where('is_active', '=', 1)->where('parent_id', '=', 0);
    }

    public function scopeChild($query){
        return $query->where('parent_id', '!=', 0);
    }

    public function getLink(){
        return Route::has($this->link) ? route($this->link) : $this->link;
    }

    public function displayParentName(){
        return $this->parent != null ? $this->parent->display : "";
    }

    public function getAllChildren(){
        return $this->hasMany('App\Models\System\Module', 'parent_id', 'id')->orderBy('sort', 'asc')
        ->where('is_active', '=', 1);
    }

    public function getAllChildrenLink()
    {
        $children = $this->hasMany('App\Models\System\Module', 'parent_id', 'id')->orderBy('sort', 'asc')
        ->where('is_active', '=', 1)->get();
        if(count($children) > 0){
           $links = [];
            foreach ($children as $index => $child) {
                array_push($links,$child->link);
            }
            return $links;
        } 
        return [];
    }
}