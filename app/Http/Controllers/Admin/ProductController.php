<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Storage;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product = Product::paginate(5);
        $data['page_title']='Product List';
        $data['data']=$product;
        return view('admin.pages.products.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = ProductCategory::get();
        $data['page_title'] = 'Create new Product';
        $data['category'] = $category;
        return view('admin.pages.products.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'product_sku'=>'required',
            'product_name'=>'required',
            'product_price'=>'required',
            'product_stock'=>'required',
            'product_image'=>'required|mimes:jpg,png',
            'category_id'=>'required',
        ]); 
        $object = $request->all();
        if ($validate) {
            if ($request->has('product_image')) {
                $object['product_image'] = Storage::disk('uploads')->put('product/gallery', $request->product_image);
            }
            $object['product_sku'] = 'PR-'.$request->category_id.'-'.$request->product_sku;
            Product::create($object);
            return redirect()->route('admin.product.index')
                ->with(['notif_status' => '1', 'notif' => 'Insert data success.']); 
            } else {
            return redirect()->back()
                ->with(['notif_status' => '0', 'notif' => 'Insert data failed.']); 
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
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = Product::findorfail($id);
        $category = ProductCategory::get();
        $data['page_title'] = 'Create new Product';
        $data['category'] = $category;
        $data['edit'] = $edit;
        $data['edit_mode'] = true;
        return view('admin.pages.products.form',$data);
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
        $validate = $request->validate([ 
            'product_name'=>'required',
            'product_price'=>'required',
            'product_stock'=>'required',
            'product_image'=>'mimes:jpg,png',
            'category_id'=>'required',
        ]); 
        $object = $request->all();
        $current = Product::findorfail($id);
        if ($validate) {
            if ($request->has('product_image')) {
                $object['product_image'] = Storage::disk('uploads')->put('product/gallery', $request->product_image);
            }   
            $current->update($object);
            return redirect()->route('admin.product.index')
                ->with(['notif_status' => '1', 'notif' => 'Insert data success.']); 
            } else {
            return redirect()->back()
                ->with(['notif_status' => '0', 'notif' => 'Insert data failed.']); 
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
        $current = Product::findorfail($id);
        File::delete('./uploads/' . $current->product_image);
        $current->delete();
        return redirect()->back()
            ->with(['notif_status' => '1', 'notif' => 'Delete data success!']);
    }
}
