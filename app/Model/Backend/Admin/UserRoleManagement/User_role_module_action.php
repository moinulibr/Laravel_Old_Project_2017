<?php

namespace App\Model\Backend\Admin\UserRoleManagement;

use Illuminate\Database\Eloquent\Model;

class User_role_module_action extends Model
{
     public function role_module()
     {
         #return $this->belongsTo(User_role_module::class,'user_role_module_id','id');
         return $this->belongsTo(User_role_module::class,'user_role_module_id','id')->whereNull('is_deleted');
     }

}
