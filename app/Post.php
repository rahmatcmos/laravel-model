<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use \App\Scope\PublishedTrait;

    protected $fillable = ['title', 'content', 'published'];
}
