<?php

namespace App\Http\Controllers\Backend\Admin\Transaction\Sale;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\Admin\TransactionHistory\Total_sale_payment_history;
use App\Model\Backend\Admin\Account\Account;
use App\Model\Backend\Admin\Account_Payment\Mobile_banking_company;
use App\Model\Backend\Admin\Account_Payment\Payment_method;
use App\Model\Backend\Admin\Account_Payment\Payment_type;
use App\Model\Backend\Admin\Product\Product\Product;
use App\Model\Backend\Admin\Transaction\Sale\Detail_sale;
use App\Model\Backend\Admin\Transaction\Sale\Final_sale;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Validator;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $data['sales'] = Final_sale::whereNull('is_deleted')->latest()->paginate(30); 
        return view("backend.admin.transaction.sale.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $data['products'] = Product::whereNull('is_deleted')->get();
        $data['clients'] = User::where('role_id',6)->whereNull('is_deleted')->get();
        $sale = Final_sale::latest()->get();
        if($sale->count() > 0)
        {
          $id =  Final_sale::latest()->first()->id;
          $id  = $id +1;
          $id = "$id";
        }
        else{
            $id = '0001'; 
        }
     
        if( $totalLen = strlen($id) < 4)
        {
            $lop = 4-$totalLen;
            $add = "0";
            for($i=1; $i<$lop; $i++)
            {
                $add .= "0"; 
            }
            $id = $add.$id;
            $count = strlen($id);
            $sub =  $count -4;
            $id =  substr($id,$sub);
        }
        $data['order_id'] = $id;
        return view("backend.admin.transaction.sale.create",$data);
    }

    #===============================================================================================
    #=====================================Sale Add To Cart==========================================
    public function saleAddToCart(Request $request)
    {
        if($request->ajax())
        {
            $saleCart = session()->get('saleCart'); 
            if($request->product_id)
            {
                $id =  $request->product_id;
                $product =  Product::findOrFail($id);
                $unit_price = $product->sale_unit_price;
                if(empty($product->sale_unit_price))
                {
                    $unit_price = 0;
                    /*
                    session('error','Product is not ready for sale! plsease update product sale unit price and others!!');
                    return view("backend.admin.transaction.sale.add-to-cart.errorPage");
                    */
                }
                if(isset($saleCart[$id])) 
                {
                    // if( $stock->quantity < ($saleCart[$id]['quantity'] + $quantity) ) continue;
                    $saleCart[$id]['quantity']++ ;
                    $saleCart[$id]['total_price'] = $saleCart[$id]['quantity'] * $saleCart[$id]['unit_price'];
                    session()->put('saleCart', $saleCart);
                }else{
                    // if item not exist in sell then add to sell with quantity
                    $saleCart[$id] = [
                        // "name" => $product_name,
                        // "quantity" => $quantity,
                        // "price" => $stock->price,
                        // "product" => $stock->product_id,

                    'product_id' => $id,
                    'product_name' => $product->name,
                    'description' => '',
                    'quantity' =>1,
                    'unit_price' => $unit_price,
                    'total_price' => $unit_price
                    ];
                    session()->put('saleCart', $saleCart);
                }
            }
            
                /*
                $saleCart = [];
                if($request->product_id)
                {
                    
                    $id =  $request->product_id;
                    $product =  Product::findOrFail($id);
                    $unit_price = $product->sale_unit_price;
                    $saleCart = session()->has('saleCart') ? session()->get('saleCart')  : [];
                    
                    if(array_key_exists($product->id,$saleCart))
                    {
                        $saleCart[$product->id]['quantity']++ ;
                        $saleCart[$product->id]['total_price'] = $saleCart[$product->id]['quantity'] * $saleCart[$product->id]['unit_price'];
                        //$saleCart[$product->id]['quantity'] += 1;
                    }   
                    else{
                        $saleCart[$product->id] = [
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'quantity' =>1,
                        'unit_price' => $unit_price,
                        'total_price' => $unit_price
                        ];
                    }
                }

                session()->put('saleCart', $saleCart);
                */
                return view("backend.admin.transaction.sale.add-to-cart.saleAddToCart");
        }
    }



    public function saleAddToCartCancelProcess()
    {
        session(['saleCart' => []]);
        return redirect()->back();
    }

    public function saleAddToCartShowCart()
    {
        return view("backend.admin.transaction.sale.add-to-cart.saleAddToCart");
    }


    public function saleAddToCartSingleRemove(Request $request)
    {
        $saleCart = session()->has('saleCart') ? session()->get('saleCart')  :[];
		unset($saleCart[$request->input('product_id')]);	
		session(['saleCart'=>$saleCart]);
        return view("backend.admin.transaction.sale.add-to-cart.saleAddToCart");
    }

    public function saleAddToCartSingleUpdate(Request $request)
    {
        $saleCart = session()->get('saleCart'); 
        if($request->ajax())
        {
            $unit_sale_price = $request->unit_sale_price;
            $quantity = $request->quantity;
            $description = $request->description;
            if($request->product_id)
            {
                $id =  $request->product_id;
                $product =  Product::findOrFail($id);
                $unit_price = $unit_sale_price;
                if(empty($product->sale_unit_price))
                {
                    $unit_price = 0;
                }

                //if( $stock->quantity < ($saleCart[$id]['quantity'] + $quantity) ) continue;
                $saleCart[$id]['quantity'] = $quantity ;
                $saleCart[$id]['unit_price'] = $unit_price ;
                $saleCart[$id]['description'] = $description ;
                $saleCart[$id]['total_price'] =  number_format((float)$saleCart[$id]['quantity'] * $saleCart[$id]['unit_price'], 2, '.', '');

                session()->put('saleCart', $saleCart);
            }
            session(['saleCart'=>$saleCart]);
            return view("backend.admin.transaction.sale.add-to-cart.saleAddToCart");
        }
    }
    #=====================================Sale Add To Cart======================================
    #===============================================================================================
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $input = $request->except('_token');
        $validator = Validator::make($input,[ 
            'sale_date' => 'required|min:10:max:10',
            'client_id' => 'required',
            'order_no' => 'required|min:2|max:30',
            'description.*' => 'required|max:100',
        ]); 
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if($request->client_id == NULL)
        {
            return back()->with('error','Client Name is Required! Please Select Client Name');
        } 

        $y = substr($request->sale_date,6);;
        $d =  substr($request->sale_date,0,2);
        $m = substr($request->sale_date,3,2);
        $date = $y."-".$m."-".$d;
        $sale_date =  date('Y-m-d',strtotime($date));
 
        
            // Start transaction!
            DB::beginTransaction();
        try { 
                $sale =  new Final_sale();
                $sale->client_id = $request->client_id;
                $sale->order_no = $request->order_no;
                $sale->sale_date = $sale_date;
                $sale->sub_total = (($request->final_total+$request->discount)-$request->fee);
                $sale->fee =$request->fee;
                $sale->discount = $request->discount;
                $sale->final_total = $request->final_total;
                $sale->paid_total = 0.00;
                $sale->due_total = $request->final_total;
                $sale->total_quantity =  $request->total_quantity;
                $sale->created_by =  Auth::user()->id;
                $save = $sale->save();
                if($save)
                {
                    $products[] =  $request->product_id;
                    $quanity[] = $request->quantity;
                    $unitePrice[]  = $request->sale_unit_price;

                    $i = 0;
                    foreach($request->product_id as  $product)
                    {
                        $sale_detail =  new Detail_sale();
                        $sale_detail->final_sale_id = $sale->id;
                        $sale_detail->client_id = $request->client_id;
                        $sale_detail->order_no = $request->order_no;
                        $sale_detail->product_id = $product;
                        $sale_detail->sale_date = $sale_date;
                        $sale_detail->quantity = $request->quantity[$i];
                        $sale_detail->unit_price =$request->sale_unit_price[$i];
                        $sale_detail->sub_total = (($request->quantity[$i]) * ($request->sale_unit_price[$i]));
                        $sale_detail->description = $request->description[$i];
                        $sale_detail->save();
                        $i++;
                    }
                }
                else{
                    throw new \Exception('Something went wrong! Please Try again');
                }
            } 
            catch(\Exception $e) 
            {
                DB::rollback();
                if($e->getMessage())
                {
                    $message = "Something went wrong! Please Try again";
                }
                return Redirect()->back()
                    ->with('error',$message);
            }
            DB::commit();
            session(['saleCart' => []]);
            //return back()->with('success','Order Processed Completed');  
            return redirect()->route('admin.transaction-sale.index')->with('success','Order Processed Completed');  

                        /*
            $sale->payment_method_from_account_id = $request->client_id;
            $sale->payment_note = $request->client_id;
            $sale->payment_method_from_account_id = $request->client_id;
            $sale->status =$request->client_id;
            $sale->created_by = $request->client_id;
            */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['final_sale'] = Final_sale::findOrFail($id); 
        $data['sale_details'] = Detail_sale::where('final_sale_id',$id)->latest()->get();
        return view("backend.admin.transaction.sale.show",$data);
    }


    public function viewDeliveryNote($id)
    {
        $data['final_sale'] = Final_sale::findOrFail($id); 
        $data['sale_details'] = Detail_sale::where('final_sale_id',$id)->latest()->get();
        return view("backend.admin.transaction.sale.delivery-note",$data);
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

    public function saleReceivePayment($id)
    {
        $data['sale'] = Final_sale::findOrFail($id);
        $data['sale_details'] = Detail_sale::where('final_sale_id',$id)
                                        ->select('*',DB::raw("(quantity*unit_price) as subtotal"))
                                        ->latest()
                                        ->get(); 
        $data['sale_details_amount'] =  $data['sale_details']->sum('subtotal');


        $data['payment_typies'] = Payment_type::whereNull('is_deleted')->latest()->get(); 
        $data['payment_methods'] = Payment_method::whereNull('is_deleted')->latest()->get(); 
        $data['mobile_bankings'] = Mobile_banking_company::whereNull('is_deleted')->latest()->get(); 
        return view("backend.admin.transaction.sale.receive-payment",$data);
    }

    #ajax
    public function saleReceivePaymentMethod(Request $request)
    {
        $payment_method_id =  $request->payment_method;
        if($payment_method_id == 1)
        {
            $accounts =  Account::where('payment_method_id',$payment_method_id)->whereNull('is_deleted')->get();
            $data = "<option disabled selected>Select One</option>";
            foreach ($accounts as $account){
                $data .= "<option value='". $account->id ."'>" . "Cash" ."</option>";
            }
            return $data;
        }
        else if( $payment_method_id == 2)
        {
            $accounts =  Account::where('payment_method_id',$payment_method_id)->whereNull('is_deleted')->get();
            $data = "<option disabled selected>Select One</option>";
            foreach ($accounts as $account){
                $data .= "<option value='". $account->id ."'>" . $account->mobile_payment_types->name ."  -  ".$account->account_no ."  -  ".$account->bank_name. "</option>";
            }
            return $data;
        }
        else if($payment_method_id == 3)
        {
            $accounts =  Account::where('payment_method_id',$payment_method_id)->whereNull('is_deleted')->get();
            $data = "<option disabled selected>Select One</option>";
            foreach ($accounts as $account){
                $data .= "<option value='". $account->id ."'>" . $account->account_name ."  -  ".$account->account_no ."  -  ".$account->bank_name. "</option>";
            }
            return $data;
        }
        else{
            return "";
        }
        
    }
 
    #receiving post method
    public function salePaymentProcess(Request $request)
    {
        $input = $request->except('_token'); 
        $validator = Validator::make($input,[ 
            'account_id' => 'required',
            'payment_date' => 'required|max:10|min:10',
            'payment_method_id' => 'required',
            'paid_total_now' => 'required',
            'payment_note' => 'nullable|max:50',
        ]);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        } 
  
       
       $y = substr($request->payment_date,6);;
       $d =  substr($request->payment_date,0,2);
       $m = substr($request->payment_date,3,2);
       $date = $y."-".$m."-".$d;
       $payment_date =  date('Y-m-d',strtotime($date));


       $paid_total = $request->before_paid_total + $request->paid_total_now;
       $due_total = $request->final_total - $paid_total;

       DB::beginTransaction();
       try { 
            $payment =  Final_sale::findOrFail($request->id);
            if($request->before_paid_total == 0 || $request->before_paid_total == NULL)
            {
                $payment->payment_type_id = ($request->final_total == $request->paid_total_now )? 1:2;
            }
            $payment->payment_method_id = $request->payment_method_id;
            if($request->account_id)
            {
                $payment->account_id = $request->account_id;
            }
            $payment->paid_total = $paid_total;
            $payment->due_total  =  $due_total;
            $payment->payment_date =  $payment_date;
            $payment->payment_received_by = Auth::user()->id;
            $payment->payment_status = (($paid_total == $request->final_total)?'Paid':'Unpaid');
            $payment->payment_note = $request->payment_note;
            $save = $payment->save();
            if(!$save)
            {
                throw new \Exception('Something went wrong! Please Try again');
            }
            $salePaymentHistory = new Total_sale_payment_history();
            $salePaymentHistory->client_id = $request->client_id; 
            $salePaymentHistory->final_sale_id = $payment->id; 
            $salePaymentHistory->payment_method_id = $request->payment_method_id; 
            $salePaymentHistory->account_id = $request->account_id; 
            $salePaymentHistory->order_no = $request->order_no; 
            $salePaymentHistory->paid_total = $request->paid_total_now; 
            $salePaymentHistory->payment_date =  $payment_date; 
            $salePaymentHistory->short_note = $request->payment_note;
            $salePaymentHistory->created_by = Auth::user()->id;
            $saleHistory = $salePaymentHistory->save();
            if(!$saleHistory)
            {
                throw new \Exception('Something went wrong! Please Try again');
            }
        } 
        catch(\Exception $e) 
        {
            DB::rollback();
            if($e->getMessage())
            {
                $message = "Something went wrong! Please Try again";
            }
            return Redirect()->back()
                ->with('error',$message);
        }
        DB::commit();
       // return back()->with('success','Payment is Processed Successfully!'); 
        return redirect()->route('admin.transaction-sale.index')->with('success','Payment is Processed Successfully!'); 
    }



    public function delete($id)
    {
        $account = Final_sale::findOrFail($id);

        if($account->saleIdAlreadyUsedToAnotherTable() || ($account->account_id != NULL || $account->account_id > 0))
        {
            $account->is_deleted = date('Y-m-d h:i:s'); 
            $delete = $account->save();

            $deleteAlls = Total_sale_payment_history::where('final_sale_id',$id)->get();
            foreach($deleteAlls as $deleteall)
            {   
                $deleteall->is_deleted = date('Y-m-d h:i:s'); 
                $delete = $deleteall->save();
            }
            $alls =  Detail_sale::where('final_sale_id',$id)->get();
           foreach($alls as $all)
           {
                $all->is_deleted = date('Y-m-d h:i:s'); 
                $delete = $all->save();
           }
        }
        else{
            $alls =  Detail_sale::where('final_sale_id',$id)->get();
            foreach($alls as $all)
            {
                $delete =    $all->delete(); 
            }
            $delete =  $account->delete();
        }

        /*
            if($account->verified == NULL)
            {
                $deleteAlls = Total_sale_payment_history::where('final_sale_id',$id)->get();
                foreach($deleteAlls as $deleteall)
                {   
                    $deleteall->delete();
                }
                $alls =  Detail_sale::where('final_sale_id',$id)->get();
            foreach($alls as $all)
            {
                    $all->delete();
            }
                $deleted = $account->delete();
            }
            else{
                $account->is_deleted = date('Y-m-d h:i:s'); 
                $deleted = $account->save();
            }
        */

        if($delete){
            return  redirect()->back()->with('success','Order  is Deleted Successfully!');
        }
       return  redirect()->back()->with('error','Order  is not Deleted!');
    }
    public function destroy($id)
    {
        //
    }
}
