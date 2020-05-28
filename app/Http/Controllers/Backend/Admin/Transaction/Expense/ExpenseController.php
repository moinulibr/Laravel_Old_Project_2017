<?php

namespace App\Http\Controllers\Backend\Admin\Transaction\Expense;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\Admin\Account\Account;
use App\Model\Backend\Admin\Account_Payment\Mobile_banking_company;
use App\Model\Backend\Admin\Account_Payment\Payment_method;
use App\Model\Backend\Admin\Account_Payment\Payment_type;
use App\Model\Backend\Admin\Transaction\Expense\Detail_expense;
use App\Model\Backend\Admin\Transaction\Expense\Final_expense;
use App\Model\Backend\Admin\Transaction\TransactionCategory\TransactionCategory;
use App\Model\Backend\Admin\TransactionHistory\Total_expense_payment_history;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['finalExpenses'] = Final_expense::whereNull('is_deleted')->latest()->paginate(30);
        return view("backend.admin.transaction.expense.index",$data); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $data['categories'] = TransactionCategory::whereNull('is_deleted')->groupBy('category_type')->get(); 
        $expense = Final_expense::latest()->get();
        if($expense->count() > 0)
        {
          $id =  Final_expense::latest()->first()->id;
          $id  = $id +1;
          $id = "$id";
        }
        else{
            $id = '0001'; 
        }
     
        if( $totalLen = strlen($id) < 4)
        {
            $lop = 4-$totalLen;
            $add = "0";
            for($i=1; $i<$lop; $i++)
            {
                $add .= "0"; 
            }
            $id = $add.$id;
            $count = strlen($id);
            $sub =  $count -4;
            $id =  substr($id,$sub);
        }
        $data['order_id'] = $id;
        return view("backend.admin.transaction.expense.create",$data);
    }




     #ajax
     public function transaction_category_type(Request $request)
     {
            $category_type =  $request->category_type;
        
            $categories =  TransactionCategory::whereNull('is_deleted')->where('category_type',$category_type)->get(); 
             $data = "<option disabled selected>Select One</option>";
             foreach ($categories as $cat)
             {
                $data .= "<option  value='". $cat->id ."'>" . $cat->name . "</option>";
             }
             return $data;
     }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except('_token'); 
        $validator = Validator::make($input,[ 
            'expense_date' => 'required|min:10|max:10',
            'category_type' => 'required',
            'expense_category_id' => 'required',
        ]);
       if($validator->fails())
       {
           return redirect()->back()->withErrors($validator)->withInput();
       }

        if($request->expense_category_id == NULL)
        {
            return back()->with('error','Expense Category  is Required! Please Select Expense Category');
        } 

        $y = substr($request->expense_date,6);;
        $d =  substr($request->expense_date,0,2);
        $m = substr($request->expense_date,3,2); 
        $date = $y."-".$m."-".$d;
        $expense_date =  date('Y-m-d',strtotime($date));
      

            // Start transaction!
            DB::beginTransaction();
        try { 
                $expense =  new Final_expense();
                $expense->category_type = $request->category_type;
                $expense->expense_category_id = $request->expense_category_id;
                $expense->reference_no = $request->reference_no;
                $expense->expense_date = $expense_date;

                //$expense->final_total = $request->final_total;
                $expense->created_by =  Auth::user()->id; 
                $save = $expense->save();
                if($save)
                {
                    $i = 0;
                    $finalAccountForFinalExpenseTable = 0;
                    foreach($request->expense_title as  $expenseTitle)
                    {
                        $sale_detail =  new Detail_expense();
                        $sale_detail->category_type = $request->category_type;
                        $sale_detail->final_expense_id = $expense->id;
                        $sale_detail->reference_no = $request->reference_no;
                        $sale_detail->expense_title = $expenseTitle;
                        $sale_detail->description = $request->description[$i];
                        $sale_detail->final_total = $request->final_total[$i];
                        # make Date
                        $ey = substr($request->expense_created_date[$i],6);;
                        $ed =  substr($request->expense_created_date[$i],0,2);
                        $em = substr($request->expense_created_date[$i],3,2); 
                        $edate = $ey."-".$em."-".$ed;
                        $expense_created_date =  date('Y-m-d',strtotime($edate));
                        $sale_detail->expense_created_date = $expense_created_date;
                        # make Date
                        $sale_detail->save();

                        $finalAccountForFinalExpenseTable += ($request->final_total[$i]);
                        $i++;
                    }
                    $expense->final_total =  $finalAccountForFinalExpenseTable;
                    $expense->save(); 
                }
                else{
                    throw new \Exception('Something went wrong! Please Try again');
                }
            } catch(\Exception $e) 
            {
                DB::rollback();
                if($e->getMessage())
                {
                    $message = "Something went wrong! Please Try again";
                }
                return Redirect()->back()
                    ->with('error',$message);
            }
            DB::commit(); 
            return redirect()->route('admin.transaction-expense.index')->with('success','Expense Processed Completed');  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
        $data['final_expense'] = Final_expense::findOrFail($id); 
        $data['expense_details'] = Detail_expense::where('final_expense_id',$id)->get();
        return view("backend.admin.transaction.expense.show",$data); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['final_expense'] =  Final_expense::findOrFail($id);
        $data['categories'] = TransactionCategory::whereNull('is_deleted')->groupBy('category_type')->get(); 
        if($data['final_expense']->account_id == NULL)
        {
            $data['order_id'] =  $data['final_expense']->reference_no;
           $data['details_expenses']  = Detail_expense::where('final_expense_id',$id)->get();
            return view("backend.admin.transaction.expense.edit",$data); 
        }
        else{
            return redirect()->back()->with('error','This Income/Expense can not edit now!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $input = $request->except('_token'); 
        $validator = Validator::make($input,[ 
            'expense_date' => 'required|min:10|max:10',
            'category_type' => 'required',
            'expense_category_id' => 'required',
        ]);
       if($validator->fails())
       {
           return redirect()->back()->withErrors($validator)->withInput();
       }

        if($request->expense_category_id == NULL)
        {
            return back()->with('error','Income / Expense Category  is Required! Please Select Expense Category');
        } 

        $y = substr($request->expense_date,6);;
        $d =  substr($request->expense_date,0,2);
        $m = substr($request->expense_date,3,2); 
        $date = $y."-".$m."-".$d;
        $expense_date =  date('Y-m-d',strtotime($date));
      

            // Start transaction!
            DB::beginTransaction();
        try { 
                $expense = Final_expense::findOrFail($id);
                if($request->category_type)
                {
                    $expense->category_type = $request->category_type;
                }
                if($request->expense_category_id)
                {
                    $expense->expense_category_id = $request->expense_category_id;
                }
                $expense->expense_date = $expense_date;

                //$expense->final_total = $request->final_total;
                $expense->created_by =  Auth::user()->id; 
                $save = $expense->save();

                if($save)
                {
                    #=================Delete Old Details_expenses=======================#
                    $old_all = Detail_expense::where('final_expense_id',$expense->id)->get();
                    $j = 0;
                    foreach($old_all as $single)
                    {
                        Detail_expense::where('id',$single->id)->first()->delete();
                        $j++;
                    }
                    #=================Delete Old Details_expenses=======================#


                    $i = 0;
                    $finalAccountForFinalExpenseTable = 0;
                    foreach($request->expense_title as  $expenseTitle)
                    {
                        $sale_detail =  new Detail_expense();
                        $sale_detail->category_type = $request->category_type;
                        $sale_detail->final_expense_id = $expense->id;
                        $sale_detail->reference_no = $request->reference_no;
                        $sale_detail->expense_title = $expenseTitle;
                        $sale_detail->description = $request->description[$i];
                        $sale_detail->final_total = $request->final_total[$i];
                        # make Date
                        $ey = substr($request->expense_created_date[$i],6);;
                        $ed =  substr($request->expense_created_date[$i],0,2);
                        $em = substr($request->expense_created_date[$i],3,2); 
                        $edate = $ey."-".$em."-".$ed;
                        $expense_created_date =  date('Y-m-d',strtotime($edate));
                        $sale_detail->expense_created_date = $expense_created_date;
                        # make Date
                        $sale_detail->save();

                        $finalAccountForFinalExpenseTable += ($request->final_total[$i]);
                        $i++;
                    }
                    $expense->final_total =  $finalAccountForFinalExpenseTable;
                    $expense->save(); 
                }
                else{
                    throw new \Exception('Something went wrong! Please Try again');
                }
            } catch(\Exception $e) 
            {
                DB::rollback();
                if($e->getMessage())
                {
                    $message = "Something went wrong! Please Try again";
                }
                return Redirect()->back()
                    ->with('error',$message);
            }
            DB::commit(); 
            return redirect()->route('admin.transaction-expense.index')->with('success','Expense Processe Updated');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function expensePayment($id)
    {
        $data['expense'] = Final_expense::findOrFail($id);
        $data['expense_details'] = Detail_expense::where('final_expense_id',$id) 
                                        ->latest()
                                        ->get(); 
        $data['expense_details_amount'] =  $data['expense_details']->sum('final_total');


        $data['payment_typies'] = Payment_type::whereNull('is_deleted')->latest()->get(); 
        $data['payment_methods'] = Payment_method::whereNull('is_deleted')->latest()->get(); 
        $data['mobile_bankings'] = Mobile_banking_company::whereNull('is_deleted')->latest()->get();
        return view("backend.admin.transaction.expense.pay-bill",$data);
    }

    #ajax
    public function expensePaymentMethod(Request $request)
    {
        $payment_method_id =  $request->payment_method;
        
        if($payment_method_id == 1)
        {
            $accounts =  Account::where('payment_method_id',$payment_method_id)->whereNull('is_deleted')->get();
            $data = "<option disabled selected>Select One</option>";
            foreach ($accounts as $account){
                $data .= "<option value='". $account->id ."'>" . "Cash" ."</option>";
            }
            return $data;
        }
        else if( $payment_method_id == 2)
        {
            $accounts =  Account::where('payment_method_id',$payment_method_id)->whereNull('is_deleted')->get();
            $data = "<option disabled selected>Select One</option>";
            foreach ($accounts as $account){
                $data .= "<option value='". $account->id ."'>" . $account->mobile_payment_types->name ."  -  ".$account->account_no ."  -  ".$account->bank_name. "</option>";
            }
            return $data;
        }
        else if($payment_method_id == 3)
        {
            $accounts =  Account::where('payment_method_id',$payment_method_id)->whereNull('is_deleted')->get();
            $data = "<option disabled selected>Select One</option>";
            foreach ($accounts as $account){
                $data .= "<option value='". $account->id ."'>" . $account->account_name ."  -  ".$account->account_no ."  -  ".$account->bank_name. "</option>";
            }
            return $data;
        }
        else{
            return "";
        }
        
    }

    public function expensePaymentProcess(Request $request)
    {
        $input = $request->except('_token'); 
            $validator = Validator::make($input,[ 
             'payment_date' => 'required|min:10|max:10',
             'payment_method_id' => 'required',
             'paid_total_now' => 'required',
             'payment_note' => 'nullable|max:50',
             'account_id' => 'required',
            ]);
            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput();
            }   
        

          # make Date
          $y = substr($request->payment_date,6);;
          $d =  substr($request->payment_date,0,2);
          $m = substr($request->payment_date,3,2); 
          $date = $y."-".$m."-".$d;
          $payment_date =  date('Y-m-d',strtotime($date));
          # make Date

       $paid_total = $request->before_paid_total + $request->paid_total_now;
       $due_total = $request->final_total - $paid_total;

       DB::beginTransaction();
       try { 
            $payment =  Final_expense::findOrFail($request->id);
            if($request->before_paid_total == 0 || $request->before_paid_total == NULL)
            {
                $payment->payment_type_id = ($request->final_total == $request->paid_total_now )? 1:2;
            }
            #$payment->payment_type_id = $request->payment_type_id;
            
            $payment->payment_method_id = $request->payment_method_id;
            if($request->account_id)
            {
                $payment->account_id = $request->account_id;
            }
            $payment->paid_total = $paid_total;
            $payment->due_total  =  $due_total;
            $payment->payment_date = $payment_date;
            $payment->payment_by = Auth::user()->id;
            $payment->payment_status = (($paid_total == $request->final_total)?'Paid':'Unpaid');
            $payment->payment_note = $request->payment_note;
            $save = $payment->save();
            if(!$save)
            {
                throw new \Exception('Something went wrong! Please Try again');
            }
            $expenseHistory = new Total_expense_payment_history();
            $expenseHistory->category_type = $request->category_type; 
            $expenseHistory->expense_category_id = $payment->expense_category_id; 
            $expenseHistory->final_expense_id = $payment->id; 
            $expenseHistory->payment_method_id = $request->payment_method_id; 
            $expenseHistory->account_id = $request->account_id; 
            $expenseHistory->reference_no = $request->reference_no; 
            $expenseHistory->paid_total = $request->paid_total_now; 
            $expenseHistory->payment_date = $payment_date;
            $expenseHistory->created_by = Auth::user()->id;
            $expHistory = $expenseHistory->save();
            if(!$expHistory)
            {
                throw new \Exception('Something went wrong! Please Try again');
            }
        } 
        catch(\Exception $e) 
        {
            DB::rollback();
            if($e->getMessage())
            {
                $message = "Something went wrong! Please Try again";
            }
            return Redirect()->back()
                ->with('error',$message);
        }
        DB::commit();
        //return back()->with('success','Payment is Processed Successfully!'); 
        return redirect()->route('admin.transaction-expense.index')->with('success','Payment is Processed Successfully');  
    }



    public function delete($id)
    {
        $account = Final_expense::findOrFail($id);
        if($account->expenseIdAlreadyUsedToAnotherTable() || $account->account_id != NULL)
        {
            $account->is_deleted = date('Y-m-d h:i:s'); 
            $deleted = $account->save();

            $deleteAlls = Total_expense_payment_history::where('final_expense_id',$id)->get();
            foreach($deleteAlls as $deleteall)
            {   
                $deleteall->is_deleted = date('Y-m-d h:i:s'); 
                $deleted = $deleteall->save();
            }
            $alls =  Detail_expense::where('final_expense_id',$id)->get();
           foreach($alls as $all)
           {
                $all->is_deleted = date('Y-m-d h:i:s');
                $deleted = $all->save();
           }
        }
        else{
            $alls =  Detail_expense::where('final_expense_id',$id)->get();
            foreach($alls as $all)
            {
                 $all->delete();
            }
             $deleted = $account->delete();
        }
        /*
            if($account->verified == NULL)
            {
                $deleteAlls = Total_expense_payment_history::where('final_expense_id',$id)->get();
                foreach($deleteAlls as $deleteall)
                {   
                    $deleteall->delete();
                }
                $alls =  Detail_expense::where('final_expense_id',$id)->get();
            foreach($alls as $all)
            {
                    $all->delete();
            }
                $deleted = $account->delete();
            }
            else{
                $account->is_deleted = date('Y-m-d h:i:s'); 
                $deleted = $account->save();
            }
        */
        if($deleted){
            return  redirect()->back()->with('success','Expense  is Deleted Successfully!');
        }
       return  redirect()->back()->with('error','Expense  is not Deleted!');
    }


    public function destroy($id)
    {
        //
    }
}
