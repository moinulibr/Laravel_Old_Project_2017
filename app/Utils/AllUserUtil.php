<?php

namespace App\Utils;

use App\Model\Backend\Admin\Transaction\Purchase\Detail_purchase;
use App\Model\Backend\Admin\Transaction\Purchase\Final_purchase;
use App\Model\Backend\Admin\Transaction\Sale\Detail_sale;
use App\Model\Backend\Admin\Transaction\Sale\Final_sale;
use App\Model\Backend\Admin\TransactionHistory\Total_bill_payment_history;
use App\Model\Backend\Admin\TransactionHistory\Total_sale_payment_history;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AllUserUtil
{
    public function image($request,$id)
    {
      if ($request) 
      {
        $ext = strtolower($request->getClientOriginalExtension());
        if ($ext != "jpg" && $ext != "jpeg" && $ext != "png" && $ext != "gif") 
        {
          $ext = '';
        } 
        else 
        {
            /*             
            if (file_exists("product-image/{$id}.{$ext}")) 
            {
                unlink("product-image/{$id}.{$ext}");
            }
            $request->move("product-image/", "{$id}.{$ext}");
            return $ext;
            */
            if(!Storage::disk('public')->exists('user-image'))
            {
                Storage::disk('public')->makeDirectory('user-image');
            }
            $image_name = $id.".".$ext;
            $imageSize = Image::make($request)->resize(150,150)->save($ext);
            Storage::disk('public')->put('user-image/'.$image_name,$imageSize);
            return $ext;
        } 
      }
      else 
      {
        return "";
        /*
        $ext = strtolower($request->file('image')->getClientOriginalExtension());
        if ($ext != "jpg" && $ext != "jpeg" && $ext != "png" && $ext != "gif") 
        {
          $ext = '';
        } 
          if (file_exists("product-image/1.{$ext}")) 
          {
              unlink("product-image/1.{$ext}");
          }
          $request->move("product-image/", "1.{$ext}");
        $ext = '';
        */
      }
    }


    public function imageDelete($id,$ext)
    {
        if(Storage::disk('public')->exists('user-image/'.$id.".".$ext)) 
        {
            Storage::disk('public')->delete('user-image/'.$id.".".$ext);
        }
    }



    public function userBio($request,$id)
    {
        if(!Storage::disk('public')->exists('usser-bio'))
        {
            Storage::disk('public')->makeDirectory('usser-bio');
        }
        Storage::put("usser-bio/{$id}.txt", $request); 
        Storage::disk('public')->put("usser-bio/{$id}", $request); 
        return 'text';
    }
    
    public function textDelete($id)
    {
        if(Storage::disk('public')->exists('user-bio/'.$id)) 
        {
            Storage::disk('public')->delete('user-bio/'.$id);
        }
    }



    #not using now, letter it will be used
    public function allUserDelete($id)
    {
      #====suplier table=========
      $purchase_final = Final_purchase::where('supplier_id',$id)->get();
      if(count($purchase_final)>0)
      {
        foreach($purchase_final as $final)
        {
          $updateFianlPurchae =  Final_purchase::where('id',$final->id)->first();
          $updateFianlPurchae->is_deleted = date('Y-m-d');
          $updateFianlPurchae->save();
        }
      }  


      $purchase_Details= Detail_purchase::where('supplier_id',$id)->get();
      if(count($purchase_Details)>0)
      {
        foreach($purchase_Details as $final)
        {
          $updateDetailPurchase =  Detail_purchase::where('id',$final->id)->first();
          $updateDetailPurchase->is_deleted = date('Y-m-d');
          $updateDetailPurchase->save();
        }
      }  

      $purchase_bill= Total_bill_payment_history::where('supplier_id',$id)->get();
      if(count($purchase_bill)>0)
      {
        foreach($purchase_bill as $final)
        {
          $updatePurchaeBIll =  Total_bill_payment_history::where('id',$final->id)->first();
          $updatePurchaeBIll->is_deleted = date('Y-m-d');
          $updatePurchaeBIll->save();
        }
      }  
      #====suplier table=========
      
      
      #====Client table=========
      $sale_final = Final_sale::where('client_id',$id)->get();
      if(count($sale_final)>0)
      {
        foreach($sale_final as $final)
        {
          $saleUpdate =  Final_sale::where('id',$final->id)->first();
          $saleUpdate->is_deleted = date('Y-m-d');
          $saleUpdate->save();
        }
      }  


      $sale_details= Detail_sale::where('client_id',$id)->get();
      if(count($sale_details)>0)
      {
        foreach($sale_details as $final)
        {
          $updateDetail =  Detail_sale::where('id',$final->id)->first();
          $updateDetail->is_deleted = date('Y-m-d');
          $updateDetail->save();
        }
      }  

      $totalSaleDelte= Total_sale_payment_history::where('client_id',$id)->get();
      if(count($totalSaleDelte)>0)
      {
        foreach($totalSaleDelte as $final)
        {
          $updateSaleTotal =  Total_sale_payment_history::where('id',$final->id)->first();
          $updateSaleTotal->is_deleted = date('Y-m-d');
          $updateSaleTotal->save();
        }
      }
      #====Client table=========

      return true;
    }





}