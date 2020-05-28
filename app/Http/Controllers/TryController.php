<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Imports\UserImport;
use App\Imports\UsersImport;
use App\Model\Backend\Admin\Product\Product\Product;
use App\Model\Backend\Admin\TransactionHistory\Total_bill_payment_history;
use App\User;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;


class TryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('try.index');
    }
    public function download_excel_file()
    {
        return Excel::download(new UserExport,'users.xlsx');
    }

    public function excel_file_upload(Request $request)
    {
        if($request->hasFile('file'))
        {
             Excel::import(new UsersImport,request()->file('file'));
            return redirect()->route('home');
        }
        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function autocomplete(Request $request)
    {
        if($request->term)
        { 
            $search = $request->term;
            return Product::where('name','like','%'.$search.'%')->get();
        }
       return Product::all();
    }

    public function autocompleteAjax(Request $request)
    {
        if($request->term)
        { 
                $search = $request->term;
                $products =  Product::where('name','like','%'.$search.'%')->get();
        
            $output = '<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="display:block;position:relation;">';
            foreach($products as $product) 
            {
                $output .='<li><a href="#" class="dropdown-item">'.$product->name.'</a> </li>';
            }
            $output .= "</ul>";
            return $output;
        }
    }



    public function downloadTest()
    {
       return $total = User::select('id')->count();
        $data['users'] = User::take(10)->skip(2)->latest()->get();
            # take = how many data , want to take
            #skip = data getting start , after 2 no 
        return view('try.download',$data);
        /*
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('try.download',$data);
        $fileName = $data['users']->issue_number;
        return $pdf->stream($fileName.'.pdf');
        */


       $data['users'] = User::paginate(1500);
      // return view('try.download',$data);
       $pdf = PDF::loadView('try.download',$data); 
       return $pdf->download('disney.pdf');

       $take = 10;
        $skip = 3;

        $currentPage = Request::get('page', 1); // Default to 1

        $comments = Comment::latest('created_at')
            ->take(10)
            ->skip($skip + (($currentPage - 1) * $take));
    }






    //public function adminindex($e,$m,$y)
    public function adminindex($m)
    {
        $k = "kdk";
        return ''.$k.'';
      return  Hash::make('dk');
        return \Crypt::encryptString('s');
        return $m;
       return \Crypt::decrypt($m);
        return ''.\Crypt::encrypt('encrypt').'';
        return \Crypt::encrypt('encrypt');
      return "dk";
    }
    public function adminindexenc()
    {
        return \Crypt::encryptString('s');
       return rand(10,20);
        $k = "dfdsd";
        return ''.$k.'';
        return "dk";
        return \Crypt::encryptString('s');
        return $m;
       return \Crypt::decrypt($m);
        return ''.\Crypt::encrypt('encrypt').'';
        return \Crypt::encrypt('encrypt');
      return "dk";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
