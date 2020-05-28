<?php

namespace App\Model\Backend\Admin\UserRoleManagement;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /*
    |-------------------------------------------------------------------------------------------
    | Role Menu Title Permission
    |----------------------------------------------------------------------
    */
    public function menuTitlePermission()
    {
        return $this->hasMany(User_role_menu_title_permition::class,'role_id','id')->where('is_active',1);
    }
    /*
    |-------------------------------------------------------------------------------------------
    | Role Menu Title Permission
    */


    /*
    |-------------------------------------------------------------------------------------------
    | Role Menu Action Permission
    |----------------------------------------------------------------------
    */
    public function menuActionPermission()
    {
        return $this->hasMany(User_role_menu_action_permition::class,'role_id','id')->where('is_active',1);
    }
    /*
    |-------------------------------------------------------------------------------------------
    | Role Menu Action Permission
    */


    /*
    |-------------------------------------------------------------------------------------------
    | Role Menu Action Permission
    |----------------------------------------------------------------------
    */
    public function moduleActionPermission()
    {
        return $this->hasMany(User_role_module_action_permition::class,'role_id','id')->where('is_active',1);
    }
    /*
    |-------------------------------------------------------------------------------------------
    | Role Menu Action Permission
    */


    public function roleIdAlreadyUsedToAnotherTable()
    {
        $roled    =   User::where('role_id',$this->id)->first();
        return($roled) ? true:false;
    }

}
