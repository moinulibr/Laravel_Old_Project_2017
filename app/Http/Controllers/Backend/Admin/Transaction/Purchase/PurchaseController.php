<?php

namespace App\Http\Controllers\Backend\Admin\Transaction\Purchase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\Admin\Account\Account;
use App\Model\Backend\Admin\Account_Payment\Mobile_banking_company;
use App\Model\Backend\Admin\Account_Payment\Payment_method;
use App\Model\Backend\Admin\Account_Payment\Payment_type;
use App\Model\Backend\Admin\Product\Product\Product;
use App\Model\Backend\Admin\Transaction\Purchase\Detail_purchase;
use App\Model\Backend\Admin\Transaction\Purchase\Final_purchase;
use App\Model\Backend\Admin\TransactionHistory\Total_bill_payment_history;
use App\User;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $data['finalPurchases'] = Final_purchase::whereNull('is_deleted')->latest()->paginate(30); 
        return view("backend.admin.transaction.purchase.index",$data); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['suppliers'] = User::whereNull('is_deleted')->where('role_id',5)->get();
        $data['products'] = Product::whereNull('is_deleted')->get(); 
        $data['clients'] = User::where('role_id',6)->whereNull('is_deleted')->get();
        $purchase = Final_purchase::latest()->get();
        if($purchase->count() > 0)
        {
          $id =  Final_purchase::latest()->first()->id;
          $id  = $id +1;
          $id = "$id";
        } 
        else{
            $id = '01'; 
        }
     /*
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
        */
        $data['order_id'] = $id;
        return view("backend.admin.transaction.purchase.create",$data);
    }



    
    #===============================================================================================
    #=====================================Sale Add To Cart==========================================
    public function purchaseAddToCart(Request $request)
    {
        if($request->ajax())
        {
            $purchaseCart = session()->get('purchaseCart'); 
            if($request->product_id){
                $id =  $request->product_id;
                $product =  Product::findOrFail($id);
                //$unit_price = $product->sale_unit_price;

                if(isset($purchaseCart[$id])) {

                    // if( $stock->quantity < ($purchaseCart[$id]['quantity'] + $quantity) ) continue;
                    $purchaseCart[$id]['quantity']++ ;
                    //$purchaseCart[$id]['total_price'] = $purchaseCart[$id]['quantity'] * $purchaseCart[$id]['unit_price'];
                    session()->put('purchaseCart', $purchaseCart);
                }else{
                    // if item not exist in sell then add to sell with quantity
                    $purchaseCart[$id] = [
                    'product_id' => $id,
                    'product_name' => $product->name,
                    'quantity' =>1,
                    'description' =>"",
                    'purchase_unit_price' =>0,
                    'sale_unit_price' =>0,
                    'total_price' => 0
                     //'unit_price' => $unit_price,
                    ];
                    session()->put('purchaseCart', $purchaseCart);
                }
            }
            




            /*
            $purchaseCart = [];
            if($request->product_id)
            {
                
                $id =  $request->product_id;
                $product =  Product::findOrFail($id);
                $unit_price = $product->sale_unit_price;
                $purchaseCart = session()->has('purchaseCart') ? session()->get('purchaseCart')  : [];
                
                if(array_key_exists($product->id,$purchaseCart))
                {
                    $purchaseCart[$product->id]['quantity']++ ;
                    $purchaseCart[$product->id]['total_price'] = $purchaseCart[$product->id]['quantity'] * $purchaseCart[$product->id]['unit_price'];
                    //$purchaseCart[$product->id]['quantity'] += 1;
                }   
                else{
                    $purchaseCart[$product->id] = [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'quantity' =>1,
                    'unit_price' => $unit_price,
                    'total_price' => $unit_price
                    ];
                }
            }

            session()->put('purchaseCart', $purchaseCart);
            */
            return view("backend.admin.transaction.purchase.add-to-cart.purchaseAddToCart");
        }
        
    }

    public function purchaseAddToCartCancelProcess()
    {
        session(['purchaseCart' => []]);
        return redirect()->back();
    }

    public function purchaseAddToCartShowCart()
    {
        return view("backend.admin.transaction.purchase.add-to-cart.purchaseAddToCart");
    }


    public function purchaseAddToCartSingleRemove(Request $request)
    {
        $purchaseCart = session()->has('purchaseCart') ? session()->get('purchaseCart')  :[];
		unset($purchaseCart[$request->input('product_id')]);	
		session(['purchaseCart'=>$purchaseCart]);
        return view("backend.admin.transaction.purchase.add-to-cart.purchaseAddToCart");
    }

    
    public function purchaseAddToCartSingleUpdate(Request $request)
    {
        if($request->ajax())
        {
            $purchaseCart = session()->get('purchaseCart'); 
            $quantity = $request->quantity;
            $description = $request->description;
            if($request->product_id)
            {
                $id =  $request->product_id;
                $purchase_unit_price = $request->unit_price;
                $sale_unit_price = $request->sale_unit_price;
                $purchaseCart[$id]['quantity']      =   $quantity;
                $purchaseCart[$id]['purchase_unit_price']      =   $purchase_unit_price;
                $purchaseCart[$id]['sale_unit_price']      =   $sale_unit_price;
                $purchaseCart[$id]['description']   =   $description;           
                $purchaseCart[$id]['total_price']   =   number_format((float)$purchaseCart[$id]['quantity'] * $purchaseCart[$id]['purchase_unit_price'], 2, '.', '');
                session()->put('purchaseCart', $purchaseCart);
            }
        }
        return view("backend.admin.transaction.purchase.add-to-cart.purchaseAddToCart");
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
        $request->reference_no_add_for_unique;
        $request->reference_no;
        $reference_no_made =   $request->reference_no_add_for_unique ."-".$request->reference_no;
        if($request->supplier_id == NULL)
        {
            return back()->with('error','Supplier Name is Required! Please Select Supplier Name');
        } 

        $input = $request->except('_token'); 
        $validator = Validator::make($input,[ 
            'reference_no' => 'required|max:40',
            'purchase_date' => 'required|min:10|max:10',
            'supplier_id' => 'required',
            'discription.*' => 'nullable|max:100',
        ]); 
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $y = substr($request->purchase_date,6);;
        $d =  substr($request->purchase_date,0,2);
        $m = substr($request->purchase_date,3,2);
        $date = $y."-".$m."-".$d;
        $purchase_date =  date('Y-m-d',strtotime($date));
      
            // Start transaction!
            DB::beginTransaction();
        try { 
                $purchase =  new Final_purchase();
                $purchase->supplier_id = $request->supplier_id;
                $purchase->reference_no = $reference_no_made;
                $purchase->purchase_date =$purchase_date;
                $purchase->sub_total = (($request->final_total+$request->discount)-$request->fee);
                $purchase->fee =$request->fee;
                $purchase->discount = $request->discount;
                $purchase->final_total = $request->final_total;
                $purchase->paid_total = 0.00;
                $purchase->due_total = $request->final_total;
              
                $purchase->created_by =  Auth::user()->id; 
                $save = $purchase->save();
                if($save)
                {
                    $products[] =  $request->product_id;
                    $quanity[] = $request->quantity;
                    $unitePrice[]  = $request->purchase_unit_price;

                    $i = 0;
                    $totalQty = 0;
                    foreach($request->product_id as  $product)
                    {
                        $sale_detail =  new Detail_purchase();
                        $sale_detail->final_purchase_id = $purchase->id;
                        $sale_detail->supplier_id = $request->supplier_id;
                        $sale_detail->reference_no = $request->reference_no;
                        $sale_detail->product_id = $product;
                        $sale_detail->quantity = $request->quantity[$i];
                        $sale_detail->purchase_date = $purchase_date;
                        $sale_detail->discription = $request->discription[$i];
                        $sale_detail->unit_price =$request->purchase_unit_price[$i];
                        $sale_detail->total = (($request->quantity[$i]) * ($request->purchase_unit_price[$i]));
                        $sale_detail->save();

                        #add Total Qty
                        $totalQty += ($request->quantity[$i]);

                        #product table
                       $product =  Product::findOrFail($product);
                       $product->purchase_unit_price    =  $request->purchase_unit_price[$i]; 
                       $product->sale_unit_price        = $request->sale_unit_price[$i];
                       $product->profit_unit_price      = ($request->sale_unit_price[$i] - $request->purchase_unit_price[$i]); 
                       $product->quantity               =  ($product->quantity + $request->quantity[$i]);  
                       $product->save();        
                        $i++;
                    }
                    #add Total Qty in Fianl Purchase Table;
                    $purchase->total_quantity =  $totalQty;
                    $purchase->save();
                }
                else{
                    throw new \Exception('Something went wrong! Please Try again');
                }
            } catch(\Exception $e) 
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
            session(['purchaseCart' => []]);
            //return back()->with('success','Purchase Processed Completed');  
            return redirect()->route('admin.transaction-purchase.index')->with('success','Purchase Processed Completed');  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['final_purchase'] = Final_purchase::findOrFail($id); 
        $data['purchase_details'] = Detail_purchase::where('final_purchase_id',$id)->get();
        return view("backend.admin.transaction.purchase.show",$data);
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

    
    public function purchaseReceivePayment($id)
    {
        $data['purchase'] = Final_purchase::findOrFail($id);
        $data['purchase_details'] = Detail_purchase::where('final_purchase_id',$id)
                                        ->select('*',DB::raw("(quantity*unit_price) as subtotal"))
                                        ->latest()
                                        ->get(); 
        $data['purchase_details_amount'] =  $data['purchase_details']->sum('subtotal');


        $data['payment_typies'] = Payment_type::whereNull('is_deleted')->latest()->get(); 
        $data['payment_methods'] = Payment_method::whereNull('is_deleted')->latest()->get(); 
        $data['mobile_bankings'] = Mobile_banking_company::whereNull('is_deleted')->latest()->get();
        return view("backend.admin.transaction.purchase.pay-bill",$data);
    }

    #ajax
    public function purchaseReceivePaymentMethod(Request $request)
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



    public function purchasePaymentProcess(Request $request)
    {
       $input = $request->except('_token'); 
           $validator = Validator::make($input,[ 
            'payment_date' => 'required|max:10|min:10',
            'payment_method_id' => 'required',
            'paid_total_now' => 'required',
            'payment_note' => 'nullable|max:50',
            'account_id' => 'required',
           ]);
           if($validator->fails())
           {
               return redirect()->back()->withErrors($validator)->withInput();
           }   
       
       
       $paid_total = $request->before_paid_total + $request->paid_total_now;
       $due_total = $request->final_total - $paid_total;

       $y = substr($request->payment_date,6);;
       $d =  substr($request->payment_date,0,2);
       $m = substr($request->payment_date,3,2);
       $date = $y."-".$m."-".$d;
       $payment_date =  date('Y-m-d',strtotime($date));

       DB::beginTransaction();
       try { 
            $pay =  Final_purchase::findOrFail($request->id);

            if($request->before_paid_total == 0 || $request->before_paid_total == NULL)
            {
                $pay->payment_type_id = ($request->final_total == $request->paid_total_now )? 1:2;
            }
            #$pay->payment_type_id = $request->payment_type_id;

            $pay->payment_method_id = $request->payment_method_id;
            if($request->account_id)
            {
                $pay->account_id = $request->account_id;
            }
            $pay->paid_total = $paid_total;
            $pay->due_total  =  $due_total;

            $pay->payment_date = $payment_date;

            $pay->payment_paid_by = Auth::user()->id;
            $pay->payment_status =(($paid_total == $request->final_total)?'Paid':'Unpaid');
            $pay->payment_note = $request->payment_note;
            $save = $pay->save();
            if(!$save)
            {
                throw new \Exception('Something went wrong! Please Try again');
            }
            $biiPayment = new Total_bill_payment_history();
            $biiPayment->supplier_id = $request->supplier_id; 
            $biiPayment->final_purchase_id = $pay->id; 
            $biiPayment->payment_method_id = $request->payment_method_id; 
            $biiPayment->account_id = $request->account_id; 
            $biiPayment->reference_no = $request->reference_no; 
            $biiPayment->paid_total = $request->paid_total_now; 
            $biiPayment->payment_date = $payment_date;
            $biiPayment->created_by = Auth::user()->id;
            $saleHistory = $biiPayment->save();
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
        //return back()->with('success','Bill Paid is  Successfully!'); 
        return redirect()->route('admin.transaction-purchase.index')->with('success','Bill Paid is  Successfully!'); 
    }



    public function delete($id)
    {
        $account = Final_purchase::findOrFail($id);
        if($account->purchaseIdAlreadyUsedToAnotherTable() || $account->account_id != NULL)
        {
            $account->is_deleted = date('Y-m-d h:i:s'); 
            $deleted = $account->save();  

            $alls =  Detail_purchase::where('final_purchase_id',$id)->get();
           foreach($alls as $all)
           {
                $all->is_deleted = date('Y-m-d h:i:s');
                $all->save();
           }

           $deleteAlls = Total_bill_payment_history::where('final_purchase_id',$id)->get();
            foreach($deleteAlls as $deleteall)
            {   
                $deleteall->is_deleted = date('Y-m-d h:i:s');
                $deleteall->save();
            }
        }
        else{
            $alls =  Detail_purchase::where('final_purchase_id',$id)->get();
            foreach($alls as $all)
            {
                 $all->delete();
            }
             $deleted = $account->delete();
        }
        
        /*
            if($account->verified == NULL)
            {
                $deleteAlls = Total_bill_payment_history::where('final_purchase_id',$id)->get();
                foreach($deleteAlls as $deleteall)
                {   
                    $deleteall->delete();
                }
            $alls =  Detail_purchase::where('final_purchase_id',$id)->get();
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
        if($deleted){
            return  redirect()->back()->with('success','Order  is Deleted Successfully!');
        }
       return  redirect()->back()->with('error','Order  is not Deleted!');
    }

    
    public function destroy($id)
    {
        //
    }
}
