<?php

namespace App\Model\Backend\Admin\Test;

use Illuminate\Database\Eloquent\Model;

class Test_details extends Model
{
    #not working
    public function test_details_typies()
    {
        return $this->hasMany(Test_details_type::class,'test_details_id','id');
    } 

}
