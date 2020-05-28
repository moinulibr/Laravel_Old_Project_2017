<?php

namespace App\Model\Backend\Admin\UserRoleManagement;

use Illuminate\Database\Eloquent\Model;

class User_role_menu_action extends Model
{
    public function menu_action()
    {
        #return $this->belongsTo(User_role_menu_title::class,"user_role_menu_title_id",'id');
        return $this->belongsTo(User_role_menu_title::class,"user_role_menu_title_id",'id')->whereNull('is_deleted');
    }


       

}
