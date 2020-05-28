<?php

namespace App\Model\Backend\Admin\TransactionHistory;

use App\Model\Backend\Admin\Transaction\Sale\Final_sale;
use Illuminate\Database\Eloquent\Model;

class Total_sale_payment_history extends Model
{
    public function final_sales()
    {
        return $this->belongsTo(Final_sale::class,'final_sale_id','id');
    }
}
