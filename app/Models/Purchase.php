<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Purchase extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
            if(empty($model->invoice_no)){
                $latest = self::latest()->first();
                $model->invoice_no = $latest ? 'INV-' . str_pad((int)substr($latest->invoice_no, 4) + 1, 6, '0', STR_PAD_LEFT) : 'INV-000001';

            }
        });
    }
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function purchaseItems()
    {
        return $this->hasMany(PurchaseItem::class);
    }
}
