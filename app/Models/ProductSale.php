<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSale extends Model
{
    public $timestamps = true;
    protected $primaryKey = 'id_product_sale';

    protected $fillable = [
        'id_product', 'id_user', 'customer_name', 'customer_email'
    ];

    public function user()
    {
        return $this->belongsTo('\App\Models\User', 'id_user', 'id_user');
    }

    public function product()
    {
        return $this->belongsTo('\App\Models\Product', 'id_product', 'id_product');
    }

    public function receipt()
    {
        return $this->belongsTo('\App\Models\Receipt', 'id_receipt');
    }
}
