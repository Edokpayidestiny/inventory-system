<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\AdjustmentHistory;
class Category extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
            $model->code = 'CAT-' . Str::upper(Str::random(6));
        });
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
    public function adjustmentHistories()
    {
        return $this->hasMany(AdjustmentHistory::class);
    }
    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
