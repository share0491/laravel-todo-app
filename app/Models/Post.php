<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $with = ['category', 'author'];
    protected $guarded = ['id'];

    // protected $fillable = ['title', 'excerpt', 'body', 'id'];

    public function scopeFilter($query, array $filters){
        //Post::newQuery()->filter()

        $query->when($filters['search'] ?? false, function($query, $search){
            $query->where('title', 'like', '%' . $search .'%')->orWhere('excerpt', 'like', '%' . $search . '%');
        });

    }
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }
}