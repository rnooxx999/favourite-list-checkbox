<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class FavouriteListsItem extends Model
{
    use HasFactory;
    protected $table ='favourite_lists_items';

    protected $fillable = [
        'list_id',
        'post_id',
    ];

    public function list()
{
    return $this->belongsTo(FavouriteUserList::class,
    'id', 'list_id' , );
}




public function posts(){
    return  $this->belongsTo(Post::class   );
}

    public function user(){
        return $this->belongsTo(User::class);
    }

}