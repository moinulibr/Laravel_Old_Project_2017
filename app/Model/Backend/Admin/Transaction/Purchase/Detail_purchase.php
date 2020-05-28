<?php

namespace App\Model\Backend\Admin\Transaction\Purchase;

use App\Model\Backend\Admin\Product\Product\Product;
use Illuminate\Database\Eloquent\Model;

class Detail_purchase extends Model
{
    public function products()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
