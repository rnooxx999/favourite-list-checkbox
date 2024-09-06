<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class FavouriteUserList extends Model
{
    use HasFactory;


    protected $table ='favourite_user_lists';

    protected $fillable = [
        'user_id',
        'list_name',

    
    ];


    public function user()
    {
        return $this->belongsTo(User::class
        ,'id' , 'user_id' 
         );
    }
    
    public function items()
    {
        return $this->hasMany(FavouriteListsItem::class
    ,
    );
    }
    public function itemsCount()
    {
        return $this->hasMany(FavouriteListsItem::class,
    'list_id','id'
    );
    }
    public function posts(){
        return  $this->belongsTo(Post::class );
    }

   
    // public function song()
    // {   
    //     return $this->belongsThrough(Lyrics::class,  Song::class,
    //     'lyrics_id', 'song_id'
    //     );
    // }
}