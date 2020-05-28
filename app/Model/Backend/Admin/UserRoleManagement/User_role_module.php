<?php

namespace App\Model\Backend\Admin\UserRoleManagement;

use Illuminate\Database\Eloquent\Model;

class User_role_module extends Model
{
    public function userModuleAction()
    {
        #return $this->hasMany(User_role_module_action::class,'user_role_module_id','id');
        return $this->hasMany(User_role_module_action::class,'user_role_module_id','id')->whereNull('is_deleted');
    }
}
