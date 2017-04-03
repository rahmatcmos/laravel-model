<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    use \App\Scope\PublishedTrait;

    protected $connection = 'mysql2';

    protected $dates = ['deleted_at'];
    /* Timestamps
    public $timestamps = false;
    */

    /* Hidden
    protected $hidden = ['description', 'stock'];
    */

    /* Visible
    protected $visible = ['name', 'price'];
    */

    public function scopeOverstock($query)
    {
        return $query->where('stock', '>', 30);
    }

    public function scopeOverprice($query)
    {
        return $query->where('price', '>', 400000000);
    }

    public function scopePremium($query)
    {
        return $query->overstock()->overprice();
    }

    // Dynamic Scope
    public function scopeLevel($query, $parameter)
    {
      switch ($parameter) {
        case 'lux':
          return $query->where('price', '>', 500000000);
          break;
        case 'mid':
          return $query->whereBetween('price', [300000000,500000000]);
          break;
        case 'entry':
          return $query->where('price', '<', 300000000);
          break;
      default:
          return $query;
          break;
      }
    }
}
