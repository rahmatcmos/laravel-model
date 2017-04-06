<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //use \App\Scope\PublishedTrait;
    use \App\Scope\Published;

    protected $fillable = ['title', 'content', 'published'];
}
