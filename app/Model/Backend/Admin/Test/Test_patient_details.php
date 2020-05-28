<?php

namespace App\Model\Backend\Admin\Test;

use App\Model\Backend\Admin\Patient\Patient;
use Illuminate\Database\Eloquent\Model;

class Test_patient_details extends Model
{
    public function tests()
    {
        return $this->belongsTo(Test::class,'test_id','id');
    }
    public function patients()
    {
        return $this->belongsTo(Patient::class,'patient_id','id');
    }

    public function test_details()
    {
        return $this->belongsTo(Test_details::class,'test_details_id','id');
    }
}
