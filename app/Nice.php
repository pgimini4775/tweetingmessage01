<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use kanazaca\CounterCache\CounterCache;

class Nice extends Model
{
    
    protected $fillable = ['user_id', 'micropost_id'];

    public function Micropost()
    {
      return $this->belongsToMany('App\Micropost');
    }

    public function User()
    {
      return $this->belongsToMany(User::class);
    }

}
