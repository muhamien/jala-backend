<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = ProductCategory::paginate(5);
        $data['page_title'] = 'Product Category list';
        $data['data']= $category;
        return view('admin.pages.products.category',$data);
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
        $validation = $request->validate([
            'category_name' => 'required'
        ]);
        $object = $request->all(); 
        ProductCategory::create($object);
        return redirect()->route('admin.category.index')
            ->with(['notif_status' => '1', 'notif' => 'Insert data success.']); 
        
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
        $edit = ProductCategory::findorfail($id);
        $category = ProductCategory::paginate(5);
        $data['page_title'] = 'Edit Product Category';
        $data['edit_mode'] = true;
        $data['edit'] = $edit;
        $data['data'] = $category;
        return view('admin.pages.products.category',$data);
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
        $validation = $request->validate([
            'category_name' => 'required'
        ]);
        $object = $request->all(); 
        $current = ProductCategory::findorfail($id);
        $current->update($object); 
        return redirect()->route('admin.category.index')
            ->with(['notif_status' => '1', 'notif' => 'Update data success.']); 
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductCategory::findorfail($id)->delete();
        return redirect()->route('admin.category.index')
                ->with(['notif_status' => '1', 'notif' => 'Delete data success.']); 
    }
}
