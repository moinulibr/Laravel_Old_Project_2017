<?php

namespace App\Http\Controllers\Backend\Admin\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\Admin\Test\Test;
use App\Model\Backend\Admin\Test\Test_details_type;
use App\Model\Backend\Admin\Test\Test_patient_details;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['tests'] =  Test::with('test_details')->findOrFail(2); //test_details_typies
         return view('backend.admin.test.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       return $request;

        foreach($request->test_details_id as $test)
        {
            $file = new Test_patient_details(); 
            $file->patient_id = $request->patient_id;
            $file->test_id = $request->test_id;
            $file->test_details_id = $test;
            $file->test_value = $request->input("test_value_".$test);
            $file->save();
        }
        return $request;
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       // $data['tests'] = Test::with('test_details')->where('id',1)->first();
        $data['testPatient'] =  Test_patient_details::with('tests','patients')
                            ->where('test_id',2)->where('patient_id',1)
                            ->groupBy('test_id')
                            ->groupBy('patient_id')
                            ->get(); 

        $data['testes'] =  Test_patient_details::with('test_details')
                            ->where('test_id',2)->where('patient_id',1)
                            ->get(); 
        return view('backend.admin.test.details',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
