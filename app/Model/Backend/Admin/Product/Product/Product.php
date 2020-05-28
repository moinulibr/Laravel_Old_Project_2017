<?php

namespace App\Model\Backend\Admin\Product\Product;

use App\Model\Backend\Admin\Product\ProductCategory\ProductCategory;
use App\Model\Backend\Admin\Transaction\Purchase\Detail_purchase;
use App\Model\Backend\Admin\Transaction\Sale\Detail_sale;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function productCategories()
    {
        return $this->belongsTo(ProductCategory::class,'product_category_id','id');
    }

    
    public function productAllReadyUsedToAnotherTable()
    {
       $finalSale       =   Detail_sale::where('product_id',$this->id)->first();
       $finalPurches    =   Detail_purchase::where('product_id',$this->id)->first();
        return($finalSale || $finalPurches) ? true:false;
    }

   

}
