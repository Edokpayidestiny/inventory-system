<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PurchaseItem extends Model
{
     protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
    public function getRouteKeyName()
    {
        return 'uuid';
    }
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
    public function product()
{
    return $this->belongsTo(Product::class);
}
}
