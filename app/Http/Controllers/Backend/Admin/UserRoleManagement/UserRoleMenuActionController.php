<?php

namespace App\Http\Controllers\Backend\Admin\UserRoleManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\Admin\UserRoleManagement\User_role_menu_action;
use App\Model\Backend\Admin\UserRoleManagement\User_role_menu_title;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserRoleMenuActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['menu_actions'] = User_role_menu_action::whereNull('is_deleted')->latest()->paginate(30);
        return view('backend.admin.user-role-management.menu.menu-action-index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['menu_titles'] = User_role_menu_title::whereNull('is_deleted')->get();
        return view('backend.admin.user-role-management.menu.menu-action-create',$data);
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
             'user_role_menu_title_id' => 'required',
             'action_name' => 'required|min:2|max:100',
             'action_checker_route_or_url' => 'required|min:2|max:150|unique:user_role_menu_actions,action_checker_route_or_url',
         ]); 
         if($validator->fails())
         {
             return redirect()->back()->withErrors($validator)->withInput();
         }
             $module =  new User_role_menu_action();
             $module->user_role_menu_title_id = $request->user_role_menu_title_id;
             $module->action_name = $request->action_name;
             $module->action_checker_route_or_url = $request->action_checker_route_or_url;
             $module->created_by = Auth::user()->id;  
             $save = $module->save();
         if($save){
             #return redirect()->route('admin.bank.index')->with($notification);
             return  redirect()->route('admin.user-role-menu-action.index')->with('success','User Role Menu Action is Created Successfully!');
         }else{
             return  redirect()->back()->with('error','User Role Menu Action is not Created!');
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
        $data['menu_action'] = User_role_menu_action::findOrFail($id);
        $data['menu_titles'] = User_role_menu_title::whereNull('is_deleted')->get();
        return view('backend.admin.user-role-management.menu.menu-action-edit',$data);
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
             'user_role_menu_title_id' => 'required',
             'action_name' => 'required|min:2|max:100',
             'action_checker_route_or_url' => 'required|min:2|max:150|unique:user_role_menu_actions,action_checker_route_or_url,'.$id,
         ]); 
         if($validator->fails())
         {
             return redirect()->back()->withErrors($validator)->withInput();
         }
             $module =  User_role_menu_action::findOrFail($id);
             $module->user_role_menu_title_id = $request->user_role_menu_title_id;
             $module->action_name = $request->action_name;
             $module->action_checker_route_or_url = $request->action_checker_route_or_url;
             $module->created_by = Auth::user()->id;  
             $save = $module->save();
         if($save){
             #return redirect()->route('admin.bank.index')->with($notification);
             return  redirect()->route('admin.user-role-menu-action.index')->with('success','User Role Menu Action is Created Successfully!');
         }else{
             return  redirect()->back()->with('error','User Role Menu Action is not Created!');
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
        $role = User_role_menu_action::findOrFail($id);
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
