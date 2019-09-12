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
    
     public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites', 'micropost_id', 'user_id')->withTimestamps();
    }
    
    public function favorite($userId)
    {
        // 既に「お気に入り」しているかの確認
        $exist = $this->is_favoriteing($userId);
        if ($exist) {
        // 既に「お気に入り」していれば何もしない
        return false;
        } else {
        // 未「お気に入り」であれば「お気に入り」する
        $this->favoriteings()->attach($userId);
        return true;
        }
    }
    
    public function unfavorite($userId)
    {
        // 既に「お気に入り」しているかの確認
        $exist = $this->is_favoriteing($userId);
        if ($exist) {
        // 既に「お気に入り」していればフォローを外す
        $this->favoriteings()->detach($userId);
        return true;
        } else {
        // 未「お気に入り」であれば何もしない
        return false;
        }
    }
    
    public function is_favoriteing($userId)
    {
        return $this->favoriteings()->where('user_id', $userId)->exists();
    }
}
