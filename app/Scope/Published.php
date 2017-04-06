<?php

namespace App\Scope;

trait Published {
    public static function bootPublished()
    {
      static::addGlobalScope(new PublishedScope);
    }
}
