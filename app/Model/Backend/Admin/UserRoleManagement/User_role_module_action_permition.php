<?php

namespace App\Model\Backend\Admin\UserRoleManagement;

use Illuminate\Database\Eloquent\Model;

class User_role_module_action_permition extends Model
{


    public function moduleAction()
    {
        return $this->belongsTo(User_role_module_action::class,'user_role_module_action_id','id');
    }

}
