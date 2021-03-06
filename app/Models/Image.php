<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';

    //Many to One relation
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }

    public static function get_with_limit($limit, array $order_by = ['id', 'asc'])
    {
        return DB::table('images')
            ->take($limit)
            ->orderBy($order_by[0], $order_by[1])
            ->get();
    }

    public function get_amount_of_likes()
    {
        return count(
            DB::table('likes')
                ->where('image_id', '=', $this->id)
                ->get()
        );
    }

    public function get_comments()
    {
        return Comment::where('image_id', '=', $this->id)
            ->limit(7)
            ->get();
    }

    public function has_a_like_from_logged_user()
    {
        if (
            count(DB::table('likes')
                ->where('image_id', '=', $this->id)
                ->where('user_id', '=', session()->get('user')->id)
                ->get()) > 0
        ) {
            return true;
        }

        return false;
    }
}
