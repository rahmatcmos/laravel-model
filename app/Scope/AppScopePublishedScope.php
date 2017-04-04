<?php

namespace App\Scope;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ScopeInterface;

class PublishedScope implements ScopeInterface {
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('published', 1);
    }
}
