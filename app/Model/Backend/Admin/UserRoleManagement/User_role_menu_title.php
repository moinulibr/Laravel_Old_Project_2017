<?php

namespace App\Model\Backend\Admin\UserRoleManagement;

use Illuminate\Database\Eloquent\Model;

class User_role_menu_title extends Model
{

        public function menuTitleUseMenePermission()
        {
            #return $this->hasMany(User_role_menu_action::class,'user_role_menu_title_id','id');
            return $this->hasMany(User_role_menu_action::class,'user_role_menu_title_id','id')->whereNull('is_deleted');
        }
}
