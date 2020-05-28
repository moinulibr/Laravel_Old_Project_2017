<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Model\Backend\Admin\Transaction\Sale\Final_sale;
use App\Model\Backend\Admin\TransactionHistory\Total_bill_payment_history;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       // Artisan::call('backup:run');
        
            /*
                $data['months'] = "[";
                for ($i = 1; $i <= 12; $i++) {
                    $data['months'] .= "'". date("F", strtotime( date( 'Y-m-01' )." + $i months")) . "',";
                }
                $data['months'] .= "]";   
               
                //get month wise data
                $data['month_data'] = "[";
                for ($i = 11; $i >= 0; $i--) {
                    $month = date("Y-m", strtotime( date( 'Y-m-01' )." - $i months"));
                    $data['month_data'] .= "'". Total_bill_payment_history::where('payment_date', 'like', $month . "%")->whereYear('payment_date', date('Y', strtotime('-1 year')))->sum('paid_total') . "',";
                }
                $data['month_data'] .= "]";
            */

            $date = date('Y');
            $data['months'] = "[";
            $data['month_data'] = "[";
            $j = 1;
            for ($i = 0; $i <= 11; $i++) 
            {
                $data['months'] .= "'".date("F", strtotime("+$i month", $date)). "',";
        
                $data['month_data'] .= "'". Total_bill_payment_history::whereMonth('payment_date', $j)->whereYear('payment_date', date('Y', strtotime('-1 year')))->sum('paid_total') . "',";
                $j++;
            }
            $data['month_data'] .= "]"; 
            $data['months'] .= "]";  
   
        return view('home',$data);
    }

    public function db()
    {
       #use Illuminate\Support\Facades\Artisan;
        Artisan::call('backup:run'); 
        return route('home');
    }
    public function databaseBackRun()
    {
       #use Illuminate\Support\Facades\Artisan;
        Artisan::call('backup:run'); 
        return back()->with('success',"Database is Successfully Backup");
    }
    public function dbBackup()
    {
       #use Illuminate\Support\Facades\Artisan;
       // Artisan::call('backup:run'); 
        /*
            dd(Storage::disk('local')->exists('laravel'));
            dd( Storage::disk('local')->get('laravel', 'Contents'));
            if(Storage::disk('public')->exists('Laravel'))
            {
                return "dk";
            }
        */
        //$data['files'] = Storage::allFiles('Laravel');
        $data['files'] = File::allFiles('storage/app/Laravel'); 
        return view('backend.admin.database-backup.database-backup',$data);
    }

    public function dbBackupDownload($getFileName)
    {
        $path = storage_path("app\Laravel/".$getFileName);
        return response()->download($path);
    }
    public function dbBackupDelete($getFileName)
    {
        Storage::delete('Laravel/'.$getFileName);
        return back()->with('success',"Deleted Successfully");
    }

        ///usr/local/bin/ea-php73 /home/milonfeni/https://www.smtradingbd.com/test/path/to/cron/artisan schedule:run >> '/dev/null' 2>&1
}
