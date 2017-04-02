<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
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
}
