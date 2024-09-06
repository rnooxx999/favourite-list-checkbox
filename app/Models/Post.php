<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table ='posts';

    protected $fillable = [
        'title',
        'subject',
    ];

    public function favourits(){
        return $this->hasMany(FavouriteListsItem::class 
        , 'post_id','id', );    
     }


}