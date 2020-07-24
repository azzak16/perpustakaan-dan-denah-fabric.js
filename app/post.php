<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class post extends Model
{
    use Sluggable;
    protected $fillable = ['title', 'content', 'thumbnail', 'slug', 'user_id', ];
    protected $dates = ['created_at'];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function getThumbnail()
    {
      if(!$this->thumbnail){
        return url('frontend/img/no-thumbnail.jpg');
      }
      return $this->thumbnail;
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
