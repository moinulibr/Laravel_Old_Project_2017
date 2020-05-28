<?php

namespace App\Model\Backend\Admin\Transaction\Expense;

use Illuminate\Database\Eloquent\Model;

class Detail_expense extends Model
{
    public function final_expenses()
    {
        return $this->belongsTo(Final_expense::class,'final_expense_id','id');
    }
}
