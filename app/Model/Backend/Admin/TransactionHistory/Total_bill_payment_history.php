<?php

namespace App\Model\Backend\Admin\TransactionHistory;

use App\Model\Backend\Admin\Transaction\Purchase\Final_purchase;
use Illuminate\Database\Eloquent\Model;

class Total_bill_payment_history extends Model
{
     public function final_purchases()
     {
         return $this->belongsTo(Final_purchase::class,'final_purchase_id','id');
     } 

      # make invoice number as he provided
    public function substr_invoice()
    {
       $count =  strpos($this->reference_no,"-");
       $result = $this->reference_no;
       if(strlen($count) > 0)
       {
            $result =  substr($this->reference_no,($count+1));
       }
       return  $result;
    }


}
