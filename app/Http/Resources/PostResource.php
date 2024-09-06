<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public $user;

    public function __construct($resource , $user) 
    {
        parent::__construct($resource);
        $this->user = $user;
    }
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'title' => $this->title,
            'subject' => $this->subject,
            'list' => $this->user
            //'user' => $this->user->contains('id',$this->id ) ?  $this->user : null,

        ];
    }
}