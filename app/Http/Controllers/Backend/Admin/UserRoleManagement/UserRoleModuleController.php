<?php

namespace App\Http\Controllers\Backend\Admin\UserRoleManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\Admin\UserRoleManagement\User_role_module;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserRoleModuleController extends Controller
{
    /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function index()
     {
             $data['roles'] = User_role_module::whereNull('is_deleted')->paginate(30); 
             return view('backend.admin.user-role-management.module.index',$data);
     }
 
     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
         //
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
             'module_name' => 'required|min:2|max:100',
         ]); 
         if($validator->fails())
         {
             return redirect()->back()->withErrors($validator)->withInput();
         }
             $module =  new User_role_module();
             $module->module_name = $request->module_name;
             $module->created_by = Auth::user()->id; 
             $save = $module->save();

         if($save){
             #return redirect()->route('admin.bank.index')->with($notification);
             return  redirect()->back()->with('success','User Role Module is Created Successfully!');
         }else{
             return  redirect()->back()->with('error','User Role Module is not Created!');
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
         //
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
            'module_name' => 'required|min:2|max:100',
        ]); 
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            $module =  User_role_module::findOrFail($id);
            $module->module_name = $request->module_name;
            $module->created_by = Auth::user()->id; 
            $save = $module->save();

        if($save){
            #return redirect()->route('admin.bank.index')->with($notification);
            return  redirect()->back()->with('success','User Role Module is Updated Successfully!');
        }else{
            return  redirect()->back()->with('error','User Role Module is not Updated!');
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
         $role = User_role_module::findOrFail($id);
         if($role->verified == NULL)
         {
             $deleted = $role->delete();
         }else{
             $role->is_deleted = date('Y-m-d h:i:s');
             $deleted = $role->save();
         }
       
         if($deleted){
             return  redirect()->back()->with('success','User Role Module is Deleted Successfully!');
         }
        return  redirect()->back()->with('error','User Role Module is not Deleted!');
     }
}