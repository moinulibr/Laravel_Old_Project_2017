<?php

namespace App\Model\Backend\Admin\Transaction\TransactionCategory;

use App\Model\Backend\Admin\Transaction\Expense\Final_expense;
use Illuminate\Database\Eloquent\Model;

class TransactionCategory extends Model
{
    public function transactionCatIdAlreadyUsedToAnotherTable()
    {
        $billPaid    =   Final_expense::where('expense_category_id',$this->id)->first();
        return($billPaid) ? true:false;
    }
}
