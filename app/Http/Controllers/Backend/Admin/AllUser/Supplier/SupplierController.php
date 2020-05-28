<?php

namespace App\Http\Controllers\Backend\Admin\AllUser\Supplier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\Admin\Transaction\Purchase\Final_purchase;
use App\User;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $user_role_id = Auth::user()->role_id;
        if($user_role_id == 5)
        {
            $data['suppliers'] = User::whereNull('is_deleted')->where('id',$user_id)->where('role_id',5)->latest()->paginate(30);
        }else{
            $data['suppliers'] = User::whereNull('is_deleted')->where('role_id',5)->latest()->paginate(30);
        }
        
        return view("backend.admin.alluser.supplier.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_id = Auth::user()->id;
        $user_role_id = Auth::user()->role_id;

        $data['supplier'] = User::findOrFail($id);
        if($user_role_id == 5)
        {
            if($data['supplier']->role_id == 5)
            {
                $data['purchase_details'] = Final_purchase::whereNull('is_deleted')->where('supplier_id',$id)->get();
            }
            else{
                return redirect()->route('admin.supplier.index')->with('error','You are not permitted to access this');
            }
        }else{
            $data['purchase_details'] = Final_purchase::whereNull('is_deleted')->where('supplier_id',$id)->get();
        }
        $data['payableAmount']  = $data['purchase_details']->sum('final_total');  
        $data['paidAmount']     = $data['purchase_details']->sum('paid_total');  
        return view("backend.admin.alluser.supplier.show",$data);
    }


    public function printAll($id)
    {
        $user_id = Auth::user()->id;
        $user_role_id = Auth::user()->role_id;

        $data['supplier'] = User::findOrFail($id);
        if($user_role_id == 5)
        {
            if($data['supplier']->role_id == 5)
            {
                $data['purchase_details'] = Final_purchase::whereNull('is_deleted')->where('supplier_id',$id)->get();
            }
            else{
                return redirect()->route('admin.supplier.index')->with('error','You are not permitted to access this');
            }
        }else{
            $data['purchase_details'] = Final_purchase::whereNull('is_deleted')->where('supplier_id',$id)->get();
        }
        $data['payableAmount']  = $data['purchase_details']->sum('final_total');  
        $data['paidAmount']     = $data['purchase_details']->sum('paid_total');  
        return view("backend.admin.alluser.supplier.print",$data);
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
        //
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
}
