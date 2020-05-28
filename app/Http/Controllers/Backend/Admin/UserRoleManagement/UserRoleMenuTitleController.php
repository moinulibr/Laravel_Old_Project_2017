<?php

namespace App\Http\Controllers\Backend\Admin\UserRoleManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\Admin\UserRoleManagement\User_role_menu_title;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserRoleMenuTitleController extends Controller
{
    /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function index()
     {
             $data['roles'] = User_role_menu_title::whereNull('is_deleted')->paginate(30); 
             return view('backend.admin.user-role-management.menu.index',$data);
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
             'menu_title' => 'required|min:2|max:100',
             'menu_title_checker_route_or_url' => 'required|min:2|max:150|unique:user_role_menu_titles,menu_title_checker_route_or_url',
         ]); 
         if($validator->fails())
         {
             return redirect()->back()->withErrors($validator)->withInput();
         }
             $module =  new User_role_menu_title();
             $module->menu_title = $request->menu_title;
             $module->menu_title_checker_route_or_url = $request->menu_title_checker_route_or_url;
             $module->created_by = Auth::user()->id;  
             $save = $module->save();

         if($save){
             #return redirect()->route('admin.bank.index')->with($notification);
             return  redirect()->back()->with('success','User Role Menu Title is Created Successfully!');
         }else{
             return  redirect()->back()->with('error','User Role Menu Title is not Created!');
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
             'menu_title' => 'required|min:2|max:100',
             'menu_title_checker_route_or_url' => 'required|min:2|max:150|unique:user_role_menu_titles,menu_title_checker_route_or_url,'.$id,
         ]); 
         if($validator->fails())
         {
             return redirect()->back()->withErrors($validator)->withInput();
         }
             $module = User_role_menu_title::findOrFail($id);
             $module->menu_title = $request->menu_title;
             $module->menu_title_checker_route_or_url = $request->menu_title_checker_route_or_url;
             $module->created_by = Auth::user()->id;  
             $save = $module->save();

         if($save){
             #return redirect()->route('admin.bank.index')->with($notification);
             return  redirect()->back()->with('success','User Role Menu Title is Updated Successfully!');
         }else{
             return  redirect()->back()->with('error','User Role Menu Title is not Updated!');
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
         $role = User_role_menu_title::findOrFail($id);
         if($role->verified == NULL)
         {
             $deleted = $role->delete();
         }else{
             $role->is_deleted = date('Y-m-d h:i:s');
             $deleted = $role->save();
         }
       
         if($deleted){
             return  redirect()->back()->with('success','User Role Menu Title is Deleted Successfully!');
         }
        return  redirect()->back()->with('error','User Role Menu Title is not Deleted!');
     }
 }
