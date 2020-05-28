<?php

namespace App\Http\Controllers\Backend\Admin\AllUser\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\Admin\Transaction\Sale\Final_sale;
use App\User;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
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
        if($user_role_id == 6)
        {
            $data['clients'] = User::whereNull('is_deleted')->where('id',$user_id)->where('role_id',6)->latest()->paginate(30);
        }
        else{
            $data['clients'] = User::whereNull('is_deleted')->where('role_id',6)->latest()->paginate(30);
        }

        return view("backend.admin.alluser.client.index",$data);
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
        //
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

        $data['client'] = User::findOrFail($id);
        if($user_role_id == 6)
        {
            if($data['client']->role_id == 6)
            {
                $data['sale_Finals'] = Final_sale::whereNull('is_deleted')->where('client_id',$id)->get();
            }
            else{
                return redirect()->route('admin.client.index')->with('error','You are not permitted to access this');
            }
        }else{
            $data['sale_Finals'] = Final_sale::whereNull('is_deleted')->where('client_id',$id)->get();
        }
       
        $data['payableAmount']  = $data['sale_Finals']->sum('final_total');  
        $data['paidAmount']     = $data['sale_Finals']->sum('paid_total');  
        return view("backend.admin.alluser.client.show",$data);
    }


    public function printAll($id)
    {
        $user_id = Auth::user()->id;
        $user_role_id = Auth::user()->role_id;

        $data['client'] = User::findOrFail($id);
        if($user_role_id == 6)
        {
            if($data['client']->role_id == 6)
            {
                $data['sale_Finals'] = Final_sale::whereNull('is_deleted')->where('client_id',$id)->get();
            }
            else{
                return redirect()->route('admin.client.index')->with('error','You are not permitted to access this');
            }
        }else{
            $data['sale_Finals'] = Final_sale::whereNull('is_deleted')->where('client_id',$id)->get();
        }
       
        $data['payableAmount']  = $data['sale_Finals']->sum('final_total');  
        $data['paidAmount']     = $data['sale_Finals']->sum('paid_total');  
        return view("backend.admin.alluser.client.print",$data);
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
