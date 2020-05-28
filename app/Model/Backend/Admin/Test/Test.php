<?php

namespace App\Model\Backend\Admin\Test;

use Illuminate\Database\Eloquent\Model;


class Test extends Model
{
    public function test_details()
    {
        return $this->hasMany(Test_details::class,'test_id','id');
    }

}
