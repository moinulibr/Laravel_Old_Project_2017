<?php

namespace App\Http\Controllers\Backend\Admin\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\Admin\Account\Account;
use App\Model\Backend\Admin\Account\Account_balance;
use App\Model\Backend\Admin\Account_Payment\Account_for_user;
use App\Model\Backend\Admin\Account_Payment\Mobile_banking_company;
use App\Model\Backend\Admin\Account_Payment\Payment_method;
use App\Model\Backend\Admin\Transaction\Sale\Final_sale;
use App\Model\Backend\Admin\TransactionHistory\Total_bill_payment_history;
use App\Model\Backend\Admin\TransactionHistory\Total_expense_payment_history;
use App\Model\Backend\Admin\TransactionHistory\Total_sale_payment_history;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PDF;
class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['accounts'] = Account::whereNull('is_deleted')->latest()->paginate(30);
        return view("backend.admin.account.index",$data);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['account_for_users'] = Account_for_user::whereNull('is_deleted')->latest()->get(); 
        $data['payment_methods'] = Payment_method::whereNull('is_deleted')->latest()->get(); 
        $data['mobile_bankings'] = Mobile_banking_company::whereNull('is_deleted')->latest()->get(); 
        return view("backend.admin.account.create",$data);
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
        if($request->payment_method_id !=1)
        {
           if($request->payment_method_id > 2)
            {
                $validator = Validator::make($input,[
                    'payment_method_id' => 'required',
                    'account_name' => 'required|min:2|max:100',
                    'account_no' => 'required|min:8|max:50',
                    'bank_name' => 'required|min:2|max:100',
                    'bank_address' => 'required|min:2|max:200',
                ]); 
            }
            else if($request->payment_method_id == 2)
            {
                $validator = Validator::make($input,[
                    'payment_method_id' => 'required',
                    'mobile_banking_type_id' => 'required',
                    'account_name' => 'required|min:2|max:100',
                    'account_no' => 'required|min:8|max:50',
                    'bank_name' => 'nullable|min:2|max:100',
                    'bank_address' => 'nullable|min:2|max:200',
                ]); 
            }
           
            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }

        $check_same_account = Account::where('account_no',$request->account_no)
                                ->where('bank_name',$request->bank_name)
                                ->whereNull('is_deleted')
                                ->count();

        if($check_same_account > 0)
        {
            return  redirect()->back()->with('error','Account is already exist!'); 
        }
        
        $account =  new Account();
        $account->account_for_user_id = $request->account_for_user_id;
        $account->payment_method_id = $request->payment_method_id;
        if($request->payment_method_id == 2)
        {
            $account->mobile_banking_type_id = $request->mobile_banking_type_id;
        }
        $account->account_name = $request->account_name;
        $account->account_no = $request->account_no;
        $account->bank_name = $request->bank_name;
        $account->bank_address = $request->bank_address;
        if($request->amount)
        {
            $account->amount = $request->amount;
        }
        $account->created_by = Auth::user()->id;
        $save = $account->save();


        if($request->amount > 0)
        {
            $ab =  new Account_balance();
            $ab->account_id = $account->id ;
            $ab->amount = $request->amount;
            $ab->created_by = Auth::user()->id;
            $ab->save();
        }
        // $input = $request->all();
        // $input['gfgs'] = $request->nmaag;
        // Account::create($input);


        if($save){
           // return  redirect()->back()->with('success','Account Created Successfully!');
            return  redirect()->route('admin.account.index')->with('success','Account Created Successfully!');
        }else{
            return  redirect()->back()->with('error','Account is not Created!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
        $data['account'] = Account::findOrFail($id);

        $data['incomeDetails'] = Total_expense_payment_history::where('account_id',$id)
                                        ->where('category_type','income')
                                        ->select("*",DB::raw("SUM(paid_total) as paid_total"))
                                        ->groupBy('account_id')
                                        ->groupBy('final_expense_id')
                                        ->get();

        $data['expensDetails'] = Total_expense_payment_history::where('account_id',$id)
                                        ->where('category_type','expense')
                                        ->select("*",DB::raw("SUM(paid_total) as paid_total"))
                                        ->groupBy('account_id')
                                        ->groupBy('final_expense_id')
                                        ->get();
        $data['purchaseDettail'] = Total_bill_payment_history::where('account_id',$id)
                                                    ->select("*",DB::raw("SUM(paid_total) as paid_total"))
                                                    ->groupBy('account_id')
                                                    ->groupBy('final_purchase_id')
                                                    ->get();
                                
        $data['saleDetails'] = Total_sale_payment_history::where('account_id',$id)
                                                    ->select("*",DB::raw("SUM(paid_total) as paid_total"))
                                                        ->groupBy('account_id')
                                                        ->groupBy('final_sale_id')
                                                        ->get();

        $data['incomeTotal']    = $data['incomeDetails']->sum('paid_total'); 

        $data['expensTotal']    = $data['expensDetails']->sum('paid_total'); 
        $data['purchaseTotal']  =  $data['purchaseDettail']->sum('paid_total'); 
        $data['saleTotal']      =  $data['saleDetails']->sum('paid_total'); 
        return view("backend.admin.account.show",$data);

            /*
        $data['post'] = DB::table('posts')
        ->select('*', DB::raw('(select sum(likes.liked) from likes where
            likes.post_id = posts.id) as totallike'),DB::raw('(select count(comments.post_id) from comments where
            comments.post_id = posts.id) as totalcomments'))
        ->paginate(3);
        */
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['account_for_users'] = Account_for_user::whereNull('is_deleted')->latest()->get(); 
        $data['payment_methods'] = Payment_method::whereNull('is_deleted')->latest()->get(); 
        $data['mobile_bankings'] = Mobile_banking_company::whereNull('is_deleted')->latest()->get(); 

        $data['account'] = Account::findOrFail($id);
        return view("backend.admin.account.edit",$data);
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
        if($request->payment_method_id !=1)
        {
           if($request->payment_method_id > 2)
            {
                $validator = Validator::make($input,[
                    'payment_method_id' => 'required',
                    'account_name' => 'required|min:2|max:100',
                    'account_no' => 'required|min:8|max:50',
                    'bank_name' => 'required|min:2|max:100',
                    'bank_address' => 'required|min:2|max:200',
                ]); 
            }
            else if($request->payment_method_id == 2){
                $validator = Validator::make($input,[
                    'payment_method_id' => 'required',
                    'mobile_banking_type_id' => 'required',
                    'account_name' => 'required|min:2|max:100',
                    'account_no' => 'required|min:8|max:50',
                    'bank_name' => 'nullable|min:2|max:100',
                    'bank_address' => 'nullable|min:2|max:200',
                ]); 
            }
           
            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }

        $account = Account::findOrFail($id);
        $account->account_for_user_id = $request->account_for_user_id;
        $account->payment_method_id = $request->payment_method_id;
        if($request->payment_method_id == 2){
            $account->mobile_banking_type_id = $request->mobile_banking_type_id;
        }
        $account->account_name = $request->account_name;
        $account->account_no = $request->account_no;
        $account->bank_name = $request->bank_name;
        $account->bank_address = $request->bank_address;
        if($request->amount)
        {
            $account->amount = $request->amount;
        }
        #$account->created_by = Auth::user()->id;
        $save = $account->save();
        if($save){
            return  redirect()->route('admin.account.index')->with('success','Account Updated Successfully!');
        }else{
            return  redirect()->back()->with('error','Account is not Updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $id; 
        return back();
    }


    public function printAll($id)
    {
        $data['account'] = Account::findOrFail($id);

        $data['incomeDetails'] = Total_expense_payment_history::where('account_id',$id)
                                        ->where('category_type','income')
                                        ->select("*",DB::raw("SUM(paid_total) as paid_total"))
                                        ->groupBy('account_id')
                                        ->groupBy('final_expense_id')
                                        ->get();

        $data['expensDetails'] = Total_expense_payment_history::where('account_id',$id)
                                        ->where('category_type','expense')
                                        ->select("*",DB::raw("SUM(paid_total) as paid_total"))
                                        ->groupBy('account_id')
                                        ->groupBy('final_expense_id')
                                        ->get();
        $data['purchaseDettail'] = Total_bill_payment_history::where('account_id',$id)
                                                    ->select("*",DB::raw("SUM(paid_total) as paid_total"))
                                                    ->groupBy('account_id')
                                                    ->groupBy('final_purchase_id')
                                                    ->get();
                                
        $data['saleDetails'] = Total_sale_payment_history::where('account_id',$id)
                                                    ->select("*",DB::raw("SUM(paid_total) as paid_total"))
                                                        ->groupBy('account_id')
                                                        ->groupBy('final_sale_id')
                                                        ->get();

        $data['incomeTotal']    = $data['incomeDetails']->sum('paid_total'); 

        $data['expensTotal']    = $data['expensDetails']->sum('paid_total'); 
        $data['purchaseTotal']  =  $data['purchaseDettail']->sum('paid_total'); 
        $data['saleTotal']      =  $data['saleDetails']->sum('paid_total'); 
        return view("backend.admin.account.printAll",$data);
    }

    /*
        public function downloadAll($id)
        {
            set_time_limit(300);
            $data['account'] = Account::findOrFail($id);
            $data['account_order_paids'] = Final_sale::whereNull('is_deleted')->where('payment_method_id',$id)->paginate(30);
            $data['totalAmount'] =  $data['account_order_paids']->sum('paid_total');


            $data['expensDetails'] = Total_expense_payment_history::where('payment_method_id',$id)
                                            ->groupBy('payment_method_id')
                                            ->groupBy('final_expense_id')
                                            ->get();
            $data['purchaseDettail'] = Total_bill_payment_history::where('payment_method_id',$id)
                                                        ->groupBy('payment_method_id')
                                                        ->groupBy('final_purchase_id')
                                                        ->get();
                                    
            $data['saleDetails'] = Total_sale_payment_history::where('payment_method_id',$id)
                                                            ->groupBy('payment_method_id')
                                                            ->groupBy('final_sale_id')
                                                            ->get();

            $data['expensTotal']    = $data['expensDetails']->sum('paid_total'); 
            $data['purchaseTotal']  =  $data['purchaseDettail']->sum('paid_total'); 
            $data['saleTotal']      =  $data['saleDetails']->sum('paid_total'); 
        //return view("backend.admin.account.printAll",$data);

        $pdf =  PDF::loadView('backend.admin.account.printAll',$data); 
        //return $pdf->save($pdf, true);
        return $pdf->download('d.pdf');
        // $pdf->stream();
        return back();
            //return $pdf->download('d.pdf');
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML('backend.admin.account.printAll',$data);
            return $pdf->stream();
        }
    */


    public function delete($id)
    {
        $account = Account::findOrFail($id);
        if($account->accountAllReadyUsedToAnotherTable() || $account->verified != NULL)
        {
            $account->is_deleted = date('Y-m-d h:i:s'); 
            $deleted = $account->save();
        }
        else{
            $deleted = $account->delete();
        }

        if($deleted){
            return  redirect()->back()->with('success','Account is Deleted Successfully!');
        }
       return  redirect()->back()->with('error','Account is not Deleted!');
    }
}
