<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductPricing extends Model
{
    protected $table = 'pricing_history';
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

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
