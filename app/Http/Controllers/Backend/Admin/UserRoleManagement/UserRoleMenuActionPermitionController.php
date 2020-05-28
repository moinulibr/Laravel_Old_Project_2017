<?php

namespace App\Http\Controllers\Backend\Admin\UserRoleManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\Admin\UserRoleManagement\Role;
use App\Model\Backend\Admin\UserRoleManagement\User_role_menu_action;
use App\Model\Backend\Admin\UserRoleManagement\User_role_menu_action_permition;
use App\Model\Backend\Admin\UserRoleManagement\User_role_menu_title;
use App\Model\Backend\Admin\UserRoleManagement\User_role_menu_title_permition;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserRoleMenuActionPermitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['roles'] = Role::with('menuActionPermission')->whereNull('is_deleted')->get();
        return view('backend.admin.user-role-management.menu.menu-action-permission-index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['user_roles'] = Role::whereNull('is_deleted')->get(); 
        $data['all_menu_titles'] = User_role_menu_title::whereNull('is_deleted')->get();
        return view('backend.admin.user-role-management.menu.menu-action-permission-create',$data);
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
            'role_id' => 'required',
            'user_role_menu_action_id' => 'required',
        ]); 
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $save = 0;
        $i = 0;
        foreach($request->user_role_menu_action_id as $value)
        {
                $alredy =   User_role_menu_action_permition::where('role_id',$request->role_id)
                                        ->where('user_role_menu_action_id',$request->user_role_menu_action_id[$i])
                                        ->where('is_active',1)
                                        ->count();
                if($alredy > 0)
                {
                    $i++;
                    continue;
                }
                $role =  new User_role_menu_action_permition();
                $role->role_id = $request->role_id;
                $role->user_role_menu_action_id = $request->user_role_menu_action_id[$i];
                $role->is_active = 1;
                $role->created_by = Auth::user()->id; 
                $save = $role->save();
            $i++;
        }

        if($save){
            return  redirect()->route('admin.role-menu-action-permition.index')->with('success','User Menu Action Permission is Created Successfully!');
        }else{
            return  redirect()->back()->with('error','User Menu Action Permission  is not Created!');
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
        $data['user_role']      = Role::findOrFail($id);
        $data['all_menu_titles'] = User_role_menu_title::whereNull('is_deleted')->get();
        return view('backend.admin.user-role-management.menu.menu-action-permission-edit',$data);
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
            'role_id' => 'required',
            'user_role_menu_action_id' => 'required',
        ]); 
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
      
        
        #Start transaction!
        DB::beginTransaction(); 
        try 
        {
            $save = 1;

            /*
            |---------------------------------------------------------
            | Delete First , which was check, but now uncheck selected
            */
            $i = 0;
            foreach($request->user_role_menu_action_id as $value)
            {
                $all =   User_role_menu_action_permition::where('role_id',$request->role_id)
                ->where('is_active',1)
                ->pluck('user_role_menu_action_id');
                    foreach($all as $single)
                    {
                        if($single != $request->user_role_menu_action_id[$i])
                        {
                            $delete =  User_role_menu_action_permition::where('role_id',$request->role_id)
                                    ->where('is_active',1)
                                    ->where('user_role_menu_action_id',$single)
                                    ->first();
                                    $delete->delete();
                        }
                
                    }  
                    $i++;
            }
            #====================end delete=============================================

            /*
            |---------------------------------------------------------
            | Check First is it already inserted or not, AND SAVE
            */
            $i = 0;
            foreach($request->user_role_menu_action_id as $value)
            {
                    $alredy =   User_role_menu_action_permition::where('role_id',$request->role_id)
                                            ->where('user_role_menu_action_id',$request->user_role_menu_action_id[$i])
                                            ->where('is_active',1)
                                            ->count();
                    if($alredy > 0)
                    {
                        $i++;
                        continue;
                    }

                    $role =  new User_role_menu_action_permition();
                    $role->role_id = $request->role_id;
                    $role->user_role_menu_action_id = $request->user_role_menu_action_id[$i];
                    $role->is_active = 1;
                    $role->created_by = Auth::user()->id; 
                    $save = $role->save();
                $i++;
            }
            ##==========End=================================================================
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

        if($save){
            return  redirect()->route('admin.role-menu-action-permition.index')->with('success','User Menu Action Permission is Updated Successfully!');
        }else{
            return  redirect()->back()->with('error','User Menu Action Permission  is not Updated!');
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
        $all = User_role_menu_action_permition::where('role_id',$id)
        ->where('is_active',1)
        ->pluck('user_role_menu_action_id');
        $del = 0;
        foreach($all as $single)
        {
            $delete =  User_role_menu_action_permition::where('role_id',$id)
                    ->where('is_active',1)
                    ->where('user_role_menu_action_id',$single)
                    ->first();
            $del =  $delete->delete();
        }
        if($del){
            return  redirect()->route('admin.role-menu-action-permition.index')->with('success','User Menu Action Permission is Deleted Successfully!');
        }else{
            return  redirect()->back()->with('error','User Menu Action Permission  is not Deleted!');
        } 
    }
}
