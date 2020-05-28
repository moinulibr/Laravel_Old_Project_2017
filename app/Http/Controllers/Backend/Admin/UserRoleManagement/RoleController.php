<?php

namespace App\Http\Controllers\Backend\Admin\UserRoleManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\Admin\UserRoleManagement\Role;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $data['roles'] = Role::whereNull('is_deleted')->orderBy('id','DESC')->paginate(30); 
            return view('backend.admin.user-role-management.user-role.index',$data);
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
            'name' => 'required|min:2|max:50|unique:roles,name',
        ]); 
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            $role =  new Role();
            $role->name = $request->name;
            $role->created_by = Auth::user()->id;
            $save = $role->save();

        if($save){
            #return redirect()->route('admin.bank.index')->with($notification);
            return  redirect()->back()->with('success','User Role Created Successfully!');
        }else{
            return  redirect()->back()->with('error','User Role is not Created!');
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
            'name' => 'required|min:2|max:50|unique:roles,name,'.$id,
        ]); 
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            $role =  Role::findOrFail($id);
            $role->name = $request->name;
            #$role->created_by = Auth::user()->id;
            $save = $role->save();

        if($save){
            #return redirect()->route('admin.bank.index')->with($notification);
            return  redirect()->back()->with('success','User Role Updated Successfully!');
        }else{
            return  redirect()->back()->with('error','User Role is not Updated!');
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
        $role = Role::findOrFail($id);
        if($role->roleIdAlreadyUsedToAnotherTable() || $role->verified != NULL)
        {
            $role->is_deleted = date('Y-m-d h:i:s');
            $deleted = $role->save();
        }
        else{
            $deleted = $role->delete();
        }
        /*
            if($role->verified == NULL)
            {
                $deleted = $role->delete();
            }else{
                $role->is_deleted = date('Y-m-d h:i:s');
                $deleted = $role->save();
            }
        */
        if($deleted){
            return  redirect()->back()->with('success','User Role is Deleted Successfully!');
        }
       return  redirect()->back()->with('error','User Role is not Deleted!');
    }



}
