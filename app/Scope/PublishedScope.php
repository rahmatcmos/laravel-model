<?php

namespace App\Scope;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class PublishedScope implements Scope {
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('published', 1);
    }

    public function remove(Builder $builder, Model $model)
    {
        $query = $builder->getQuery();
        foreach ((array) $query->wheres as $key => $where)
        {
            // mengecek apakah opsi where ini merupakan constraint untuk published
            if ($where['type'] == 'Basic' && $where['column'] == 'published' && $where
            ['value'] == 1) {
            // menghapus query dari opsi where
            unset($query->wheres[$key]);
            $query->wheres = array_values($query->wheres);
            // menghapus binding
            $bindings = $query->getRawBindings()['where'];
            unset($bindings[$key]);
            $query->setBindings($bindings);
          }
        }
        return $query;
    }
}
