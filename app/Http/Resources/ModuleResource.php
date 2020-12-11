<?php

namespace App\Http\Resources;

use App\Models\System\Module;
use Illuminate\Http\Resources\Json\JsonResource;

class ModuleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request){
        return [
            'id' => $this->id,
            'name' => $this->name,
            'display' => $this->display,
            'link' => $this->link,
            'symbol' => $this->symbol,
            'sort' => $this->sort,
            'parent_id' => $this->parent_id,
            'is_active' => $this->is_active,
            'children' => $this->getAllChildren()->get(),
            'children_link' => $this->getAllChildrenLink(),
        ];
    }
} 