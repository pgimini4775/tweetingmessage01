<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'gender',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function microposts()
    {
        return $this->hasMany(Micropost::class);
    }
    
    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }
    
    public function favorite()
    {
        return $this->belongsToMany(Micropost::class, 'user_favorite', 'user_id', 'favorite_id')->withTimestamps();
    }
    
    public function nice()
    {
      return $this->belongsToMany(Micropost::class, 'user_nice', 'user_id', 'nice_id')->withTimestamps();
    }

    
    public function follow($userId)
    {
        // 既にフォローしているかの確認
        $exist = $this->is_following($userId);
        // 相手が自分自身ではないかの確認
        $its_me = $this->id == $userId;
    
        if ($exist || $its_me) {
            // 既にフォローしていれば何もしない
            return false;
        } else {
            // 未フォローであればフォローする
            $this->followings()->attach($userId);
            return true;
        }
    }
    
    public function unfollow($userId)
    {
        // 既にフォローしているかの確認
        $exist = $this->is_following($userId);
        // 相手が自分自身ではないかの確認
        $its_me = $this->id == $userId;
    
        if ($exist && !$its_me) {
            // 既にフォローしていればフォローを外す
            $this->followings()->detach($userId);
            return true;
        } else {
            // 未フォローであれば何もしない
            return false;
        }
    }
     public function is_following($userId)
    {
        return $this->followings()->where('follow_id', $userId)->exists();
    }
    
    
      public function favo($userId)
    {
       
        $exist = $this->is_favorite($userId);

        if ($exist) {
           
            return false;
        } else {
           
            $this->favorite()->attach($userId);
            return true;
        }
    }
    

    
    public function unfavo($userId)
    
     {
       
        $exist = $this->is_favorite($userId);
        
        $its_me = $this->id == $userId;
    
        if ($exist && !$its_me) {
            // 既にお気に入りしていればお気に入りを外す
            $this->favorite()->detach($userId);
            return true;
        } else {
            // 未お気に入りであれば何もしない
            return false;
        }
    }
    
    public function is_favorite($userId)
    {
        return $this->favorite()->where('favorite_id', $userId)->exists();
    }



    public function feed_microposts()
    {
        $follow_user_ids = $this->followings()->pluck('users.id')->toArray();
        $follow_user_ids[] = $this->id;
        return Micropost::whereIn('user_id', $follow_user_ids);
    }

    public function good($userId)
    {
       
        $exist = $this->is_nicing($userId);

        if ($exist) {
           
            return false;
        } else {
           
            $this->nice()->attach($userId);
            return true;
        }
    }
    

    
    public function bad($userId)
    
     {
       
        $exist = $this->is_nicing($userId);
        
        $its_me = $this->id == $userId;
    
        if ($exist && !$its_me) {
            
            $this->nice()->detach($userId);
            return true;
        } else {
            
            return false;
        }
    }
    
    public function is_nicing($userId)
    {
        return $this->nice()->where('nice_id', $userId)->exists();
    }
}    