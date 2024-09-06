<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FavouriteListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        // $likesList = [];
        // $likesUser = $this->likes;
        // foreach ($likesUser as $likesss) {
        //     $likesList[] = $likesss;
        // }
        return [
            'id' => $this->id,
          //  'is_admin' => $this->is_admin,
            'list_id' => $this->name,
            'list_name' => $this->name,
    
        ];
    }
}