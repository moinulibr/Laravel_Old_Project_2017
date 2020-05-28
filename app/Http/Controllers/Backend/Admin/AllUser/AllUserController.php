<?php

namespace App\Http\Controllers\Backend\Admin\AllUser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\Admin\Transaction\Purchase\Final_purchase;
use App\Model\Backend\Admin\UserRoleManagement\Role;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Utils\AllUserUtil;
use Illuminate\Support\Facades\Storage;

class AllUserController extends Controller
{

    protected $allUserUtil;
    public function __construct(AllUserUtil $allUserUtil) 
    {
        $this->allUserUtil = $allUserUtil;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return back();
        return view("backend.admin.alluser.client.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createFrom($user)
    {
        if($user == "client")
        {
            $data['user_type'] = "client";
        }elseif($user == "supplier")
        {
            $data['user_type'] = "supplier";
        }
        elseif($user == "employee")
        {
            $data['user_type'] = "employee";  
        }
        else{
            return back();
        }
        $data['roles'] = Role::whereNull('is_deleted')->get();
        return view("backend.admin.alluser.form.create",$data);
    }



    public function create()
    {
        return back();
        return view("backend.admin.alluser.client.create");
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
        if($request->user_type =='employee')
        {
            $validator = Validator::make($input,[
                'name' => 'required|min:2|max:191',
                'email' => 'required|max:191|unique:users,email',
                'phone' => 'required|unique:users,phone|max:15|min:11',
                'phone_2' => 'nullable|unique:users,phone_2|max:15|min:11',
                'id_no' => 'required|unique:users,id_no|max:100|min:6',
                'role_id' => 'required',
                'address' => 'nullable|max:200|min:2',
                'gender' => 'required|min:2|max:10',
                'image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:20000',
                'blood_group' => 'nullable',
                'religion' => 'required|min:1|max:30',
                'password' => 'required|min:6|confirmed|max:150',
                'password_confirmation' => 'required|min:6',
            ]); 
        }
        else{
            $validator = Validator::make($input,[
                'name' => 'required|min:2|max:191',
                'email' => 'required|max:191|unique:users,email',
                'phone' => 'required|unique:users,phone|max:15|min:11',
                'phone_2' => 'nullable|unique:users,phone_2|max:15|min:11',
                'company_name' => 'required|max:100|min:2',
                'role_id' => 'required',
                'address' => 'nullable|max:200',
                'image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:20000',
                'password' => 'required|min:6|confirmed|max:150',
                'password_confirmation' => 'required|min:6',
            ]);   
        }
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user  = new User();
        $user->name = $request->name;    
        $user->email = $request->email;    
        $user->password =  Hash::make($request->password);  
        $user->phone = $request->phone;    
        $user->phone_2 = $request->phone_2;       
        $user->address = $request->address;    
        $user->name = $request->name;  
        if($request->user_type =='employee')
        {
            $user->role_id = $request->role_id; 
            $user->id_no = $request->id_no;    
            $user->gender = $request->gender;    
            $user->blood_group = $request->blood_group;    
            $user->religion = $request->religion;    
            $user->bio = $request->bio ;   
        }else{
            if($request->user_type =='supplier')
            {
                $user->role_id = 5;
            }else{$user->role_id = 6;}
            $user->company_name = $request->company_name;  
        }  
        $save = $user->save();

        /*
        if($request->bio)
        {
            $upload =  $this->allUserUtil->userBio($request->bio,$user->id);
            $user->bio = $upload;
            $user->save();
        }
        */

        if($request->file('image')){
            $upload =  $this->allUserUtil->image($request->file('image'),$user->id); 
            $user->image = $upload;
            $user->save();
        }
       
        if($save)
        {
           if($request->user_type =='employee'){
            return redirect()->route('admin.employee.index')->with('success','Employee Created Successfully');
           }
           else if($request->user_type =='supplier')
           {
            return redirect()->route('admin.supplier.index')->with('success','Supplier Created Successfully');
           } 
           else if($request->user_type =='client')
           {
            return redirect()->route('admin.client.index')->with('success','Client Created Successfully');
           } 
           else{
                return redirect()->route('admin.client.index')->with('success','User Created Successfully');
           }
        }else{
            return redirect()->back()->with('error','"'.$request->user_type.'"Created Successfully');
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
    public function editFrom($user,$id)
    {
        if($user == "client")
        {
            $data['user_type'] = "client";
        }elseif($user == "supplier")
        {
            $data['user_type'] = "supplier";
        }
        elseif($user == "employee")
        {
            $data['user_type'] = "employee";  
        }
        else{
            return back();
        }
        $data['roles'] = Role::whereNull('is_deleted')->get();
        $data['user'] = User::findOrFail($id);
        return view("backend.admin.alluser.form.edit",$data);
    }



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
        if($request->user_type =='employee')
        {
            $validator = Validator::make($input,[
                'name' => 'required|min:2|max:191',
                'email' => 'required|max:191|unique:users,email,'.$id,
                'phone' => 'required|max:15|min:11|unique:users,phone,'.$id,
                'phone_2' => 'nullable|max:15|min:11|unique:users,phone_2,'.$id,
                'id_no' => 'required|max:100|min:6|unique:users,id_no,'.$id,
                'role_id' => 'required',
                'address' => 'nullable|max:200|min:2',
                'gender' => 'required|min:2|max:10',
                'image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:20000',
                'blood_group' => 'nullable',
                'religion' => 'required|min:1|max:30',
                'password' => 'nullable|min:6|confirmed|max:150',
                'password_confirmation' => 'nullable|min:6',
            ]); 
        }
        else{
            $validator = Validator::make($input,[
                'name' => 'required|min:2|max:191',
                'email' => 'required|max:191|unique:users,email,'.$id,
                'phone' => 'required|max:15|min:11|unique:users,phone,'.$id,
                'phone_2' => 'nullable|max:15|min:11|unique:users,phone_2,'.$id,
                'company_name' => 'required|max:100|min:2',
                'role_id' => 'required',
                'address' => 'nullable|max:200',
                'image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:20000',
                'password' => 'nullable|min:6|confirmed|max:150',
                'password_confirmation' => 'nullable|min:6',
            ]);   
        }
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user  = User::findOrFail($id);
        $user->name = $request->name;    
        $user->email = $request->email; 
        if($request->password)   
        {
            $user->password =  Hash::make($request->password);  
        }
        $user->phone = $request->phone;    
        $user->phone_2 = $request->phone_2;       
        $user->address = $request->address;    
        $user->name = $request->name;  
        if($request->user_type =='employee')
        {
            $user->role_id = $request->role_id; 
            $user->id_no = $request->id_no;    
            $user->gender = $request->gender;    
            $user->blood_group = $request->blood_group;    
            $user->religion = $request->religion;
            $user->bio = $request->bio ;   
        }else{
            if($request->user_type =='supplier')
            {
                $user->role_id = 5;
            }else{$user->role_id = 6;}
            $user->company_name = $request->company_name;  
        }  
        $save = $user->save();


        /*
        if($request->bio)
        {
            #image delete
            $this->allUserUtil->textDelete($id);

            $upload =  $this->allUserUtil->userBio($request->bio,$user->id);
            $user->bio = $upload;
            $user->save();
        }
        */

        #Check And Delete, upload photo 
        if($request->file('image'))
        {
            #image delete
            $this->allUserUtil->imageDelete($id,$user->image);
            #image upload
            $upload =  $this->allUserUtil->image($request->file('image'),$user->id);
            $user->image = $upload;
            $user->save();
        }
        
        if($save)
        {
           if($request->user_type =='employee'){
            return redirect()->route('admin.employee.index')->with('success','Employee Updated Successfully');
           }
           else if($request->user_type =='supplier')
           {
            return redirect()->route('admin.supplier.index')->with('success','Supplier Updated Successfully');
           } 
           else if($request->user_type =='client')
           {
            return redirect()->route('admin.client.index')->with('success','Client Updated Successfully');
           } 
           else{
                return redirect()->route('admin.client.index')->with('success','User Updated Successfully');
           }
        }else{
            return redirect()->back()->with('error','"'.$request->user_type.'"Updated Successfully');
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
    public function delete($user,$id)
    {
        if(Auth::user()->id == $id)
        {
             return  redirect()->back()->with('error','You can not delete your own account!');
        }
        $user = User::findOrFail($id);
        if($user->userAlreadyToAnotherTable() || $user->verified != NULL)
        {
            $user->is_deleted = date('Y-m-d h:i:s');
            $deleted = $user->save();
        }
        else{
            #image delete
            $this->allUserUtil->imageDelete($id,$user->image);
            $deleted = $user->delete();
        }

        /*
            if($user->verified == NULL)
            {   
                #image delete
                $this->allUserUtil->imageDelete($id);
                $deleted = $user->delete();
            }else{
                #all table soft delete by this user id
                $this->allUserUtil->allUserDelete($id);

                $user->is_deleted = date('Y-m-d h:i:s');
                $deleted = $user->save();
            }
        */
        /*
            if($account->userAlreadyToAnotherTable() || $account->verified != NULL)
            {
                $account->is_deleted = date('Y-m-d h:i:s'); 
                $deleted = $account->save();
            }
            else{
                $deleted = $account->delete();
            }
        */

        if($deleted){
            return  redirect()->back()->with('success','Action is Deleted Successfully!');
        }
       return  redirect()->back()->with('error','Action is not Deleted!');
    }
}
