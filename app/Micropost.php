<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    protected $fillable = ['content', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function favo_user()
    {
        return $this->belongsToMany(User::class,'user_favorite','favorite_id','user_id')->withTimestamps();
    }
    
    public function nices()
    {
      return $this->hasMany('App\Nice');
    }

}
