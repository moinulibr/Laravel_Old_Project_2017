<?php

namespace App\Model\Backend\Admin\Product\ProductCategory;

use App\Model\Backend\Admin\Product\Product\Product;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    public function productCategoryAlreadyUsedToAnotherTable()
    {
       $product = Product::where('product_category_id',$this->id)->first();
        return($product) ? true:false;
    }
}
