<?php

namespace App\Model\Backend\Admin\TransactionHistory;

use App\Model\Backend\Admin\Transaction\Expense\Final_expense;
use Illuminate\Database\Eloquent\Model;

class Total_expense_payment_history extends Model
{
    public function final_expenses()
    {
        return $this->belongsTo(Final_expense::class,'final_expense_id','id');
    }
}
