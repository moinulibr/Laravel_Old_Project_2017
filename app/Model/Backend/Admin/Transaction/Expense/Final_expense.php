<?php

namespace App\Model\Backend\Admin\Transaction\Expense;

use App\Model\Backend\Admin\Account_Payment\Payment_method;
use App\Model\Backend\Admin\Transaction\TransactionCategory\TransactionCategory;
use App\Model\Backend\Admin\TransactionHistory\Total_expense_payment_history;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Final_expense extends Model
{
    public function categories()
    {
        return $this->belongsTo(TransactionCategory::class,'expense_category_id','id');
    }

    public function users()
    {
        return $this->belongsTo(User::class,'created_at','id');
    }

    public function paymentMethods()
    {
        return $this->belongsTo(Payment_method::class,'payment_method_id','id');
    }

    public function expenseIdAlreadyUsedToAnotherTable()
    {
        $billPaid    =   Total_expense_payment_history::where('final_expense_id',$this->id)->first();
        return($billPaid) ? true:false;
    }

    public function total_expense_payment_histories()
    {
        return $this->hasMany(Total_expense_payment_history::class,'final_expense_id','id');
    }

}
