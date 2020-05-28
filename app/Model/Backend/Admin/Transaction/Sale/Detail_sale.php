<?php

namespace App\Model\Backend\Admin\Transaction\Sale;

use App\Model\Backend\Admin\Product\Product\Product;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Detail_sale extends Model
{
    public function users()
    {
        return $this->belongsTo(User::class,'client_id','id');
    }
    
    public function products()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
