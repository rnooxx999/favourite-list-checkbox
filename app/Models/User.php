<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{

    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

   
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    //
    public function favouriteUserLists()
    {
        return $this->hasMany(FavouriteUserList::class
       , 'user_id',  'id' ,
    );
    }

    public function favouriteThroughItemes()
    {
        return $this->hasManyThrough(
            FavouriteListsItem::class,
            FavouriteUserList::class
            ,
            'user_id',
            'list_id',
            'id',
            'id',
        );
    }

    public function getJWTIdentifier(){
        return $this->getKey() ;
    }

    public function getJWTCustomClaims(){
        return [] ;
    }
}