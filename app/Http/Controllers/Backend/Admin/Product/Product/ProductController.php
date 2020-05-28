<?php

namespace App\Http\Controllers\Backend\Admin\Product\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\Admin\Product\Product\Product;
use App\Model\Backend\Admin\Product\ProductCategory\ProductCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Utils\AllUserUtil; 
use App\Utils\ProductUtil; 

class ProductController extends Controller
{

    protected $allUserUtil;
    protected $productUtil;
    public function __construct(AllUserUtil $allUserUtil, ProductUtil $productUtil) 
    {
        $this->allUserUtil = $allUserUtil;
        $this->productUtil = $productUtil;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $data['products'] = Product::whereNull('is_deleted')->latest()->paginate(30); 
        return view("backend.admin.product.product.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['productCategories'] = ProductCategory::whereNull('is_deleted')->get();
        return view("backend.admin.product.product.create",$data);
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
            'product_type' => 'required',
            'name' => 'required|min:2|max:150|unique:products,name',
            'product_category_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif',
        ]); 
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

       $product =  new Product();
       $product->product_type = $request->product_type;
       $product->name = $request->name;
       $product->product_category_id = $request->product_category_id;
       $product->created_by = Auth::user()->id; 
       $save = $product->save();
       $id =  $product->id;
       $upload =  $this->productUtil->image($request->file('image'),$id);
       $product->image = $upload;
       $product->save();
       if($save){
           return  redirect()->route('admin.product.index')->with('success','Product Created Successfully!');
       }else{
           return  redirect()->back()->with('error','Product is not Created!');
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
        $data['product'] = Product::findOrFail($id); 
        $data['productCategories'] = ProductCategory::whereNull('is_deleted')->get();
        return view("backend.admin.product.product.edit",$data);
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
            'product_type' => 'required',
            'name' => 'required|min:2|max:150|unique:products,name,'.$id,
            'product_category_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif',
        ]); 
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

       $product =  Product::findOrFail($id);
       $product->product_type = $request->product_type;
       $product->name = $request->name;
       $product->product_category_id = $request->product_category_id;
       #$product->created_by = Auth::user()->id; 
       $save = $product->save();
       $id =  $product->id;

       if($request->file('image'))
       {
            #image delete
            $this->productUtil->imageDelete($id);
            #image upload
            $upload =  $this->productUtil->image($request->file('image'),$id);
            $product->image = $upload;
            $product->save();
       }
       if($save){
           return  redirect()->route('admin.product.index')->with('success','Product Updated Successfully!');
       }else{
           return  redirect()->back()->with('error','Product is not Updated!');
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
        $product = Product::findOrFail($id);

        if($product->productAllReadyUsedToAnotherTable() || $product->verified != NULL)
        {   
            $product->is_deleted = date('Y-m-d h:i:s');
            $deleted = $product->save();
        }else{
            #image delete
            $this->productUtil->imageDelete($id);
            $deleted = $product->delete();
        }
      
        if($deleted){
            return  redirect()->back()->with('success','Product is Deleted Successfully!');
        }
       return  redirect()->back()->with('error','Product is not Deleted!');
    }
}
