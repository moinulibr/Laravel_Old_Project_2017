<?php

namespace App\Model\Backend\Admin\UserRoleManagement;

use Illuminate\Database\Eloquent\Model;

class User_role_menu_action_permition extends Model
{
    public function menuAction()
    {
        #return $this->belongsTo(User_role_menu_action::class,'user_role_menu_action_id','id');
        return $this->belongsTo(User_role_menu_action::class,'user_role_menu_action_id','id')->whereNull('is_deleted');
    }
}
