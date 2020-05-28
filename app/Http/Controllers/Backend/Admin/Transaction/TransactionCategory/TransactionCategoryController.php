<?php

namespace App\Http\Controllers\Backend\Admin\Transaction\TransactionCategory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\Admin\Transaction\Expense\Final_expense;
use App\Model\Backend\Admin\Transaction\TransactionCategory\TransactionCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class TransactionCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['transactionCategories'] = TransactionCategory::whereNull('is_deleted')->latest()->paginate(30); 
        return view("backend.admin.transaction.transaction-category.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'category_type' => 'required',
            'name' => 'required|min:2|max:100',
        ]); 
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            $product_category =  new TransactionCategory();
            $product_category->category_type = $request->category_type;
            $product_category->name = $request->name;
            $product_category->created_by = Auth::user()->id;
            $save = $product_category->save();

        if($save){
            return  redirect()->back()->with('success','Transaction Category Created Successfully!');
        }else{
            return  redirect()->back()->with('error','Transaction Category is not Created!');
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'category_type' => 'required',
            'name' => 'required|min:2|max:100',
        ]); 
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            $product_category =  TransactionCategory::findOrFail($id);
            $product_category->category_type = $request->category_type;
            $product_category->name = $request->name;
            #$product_category->created_by = Auth::user()->id;
            $save = $product_category->save();
        if($save){
            return  redirect()->back()->with('success','Transaction Category Updated Successfully!');
        }else{
            return  redirect()->back()->with('error','Transaction Category is not Updated!');
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
        //
    }

    public function delete($id)
    {
        $transaction_category = TransactionCategory::findOrFail($id);
        if($transaction_category->transactionCatIdAlreadyUsedToAnotherTable())
        {
            $transaction_category->is_deleted = date('Y-m-d h:i:s');
            $deleted = $transaction_category->save();
        }
        else{
            $deleted = $transaction_category->delete(); 
        }
        /*
            if($transaction_category->verified == NULL)
            {
                $deleted = $transaction_category->delete();
            }else{
                $transaction_category->is_deleted = date('Y-m-d h:i:s');
                $deleted = $transaction_category->save();
            }
      */
        if($deleted){
            return  redirect()->back()->with('success','Transaction Category is Deleted Successfully!');
        }
       return  redirect()->back()->with('error','Transaction Category is not Deleted!');
    }
}
