<?php

namespace App\Http\Controllers\Backend\Admin\Product\ProductCategory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\Admin\Product\ProductCategory\ProductCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $data['product_categorys'] = ProductCategory::whereNull('is_deleted')->latest()->paginate(30);
        return view("backend.admin.product.product-category.index",$data);
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
        $input = $request->except('_token');
        $validator = Validator::make($input,[
            'name' => 'required|min:2|max:100|unique:product_categories,name',
        ]); 
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            $product_category =  new ProductCategory();
            $product_category->name = $request->name;
            $product_category->created_by = Auth::user()->id;
            $save = $product_category->save();

        if($save){
            return  redirect()->back()->with('success','Product Category Created Successfully!');
        }else{
            return  redirect()->back()->with('error','Product Category is not Created!');
        }
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
        return back();
        $data['category'] = ProductCategory::findOrFail($id);
        return view("backend.admin.product.product-category.edit",$data);
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
        $input = $request->except('_token');
        $validator = Validator::make($input,[
            'name' => 'required|min:2|max:100|unique:product_categories,name,'.$id
        ]); 
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            $product_category =   ProductCategory::findOrFail($id);
            $product_category->name = $request->name;
            #$product_category->created_by = Auth::user()->id;
            $save = $product_category->save();

        if($save){
            return  redirect()->back()->with('success','Product Category Updated Successfully!');
        }else{
            $notification = array(
                'messege' => 'Bank is Not Added!',
                'alert-type' => 'error'
            );
            return  redirect()->back()->with('error','Product Category is not Updated!');
        }
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
    public function delete($id)
    {   
        $product_category = ProductCategory::findOrFail($id);
        if($product_category->productCategoryAlreadyUsedToAnotherTable()  || $product_category->verified != NULL)
        {
            $product_category->is_deleted = date('Y-m-d h:i:s');
            $deleted = $product_category->save();
        }else{
            $deleted = $product_category->delete();
        }
      
        if($deleted){
            return  redirect()->back()->with('success','Product Category is Deleted Successfully!');
        }
       return  redirect()->back()->with('error','Product Category is not Deleted!');
    }
}
