<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductLog extends Model
{
    // Aktifkan mass assignment
    protected $fillable = ['product_id', 'changes'];

    // Menggunakan mutator
    public function setChangesAttribute($value)
    {
        $this->attributes['changes'] = json_encode($value);
    }

    // Menggunakan accessor
    public function getChangesAttribute($value)
    {
        return json_decode($value);
    }
}
