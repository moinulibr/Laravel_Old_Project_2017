<?php

namespace App\Utils;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductUtil 
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
            if(!Storage::disk('public')->exists('product-image'))
            {
                Storage::disk('public')->makeDirectory('product-image');
            }
            $image_name = $id;
            $imageSize = Image::make($request)->resize(150,150)->save($ext);
            Storage::disk('public')->put('product-image/'.$image_name,$imageSize);
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


    public function imageDelete($id)
    {
        if(Storage::disk('public')->exists('product-image/'.$id))
        {
            Storage::disk('public')->delete('product-image/'.$id);
        }
    }



}