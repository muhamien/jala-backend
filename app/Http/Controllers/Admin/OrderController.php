<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::with('user')->latest()->paginate(5);
        // dd($order);
        $data['page_title']='Order List';
        $data['data']=$order;
        return view('admin.pages.orders.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['user'] = User::get();
        $data['page_title']='Create Purchase Order';
        return view('admin.pages.orders.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $validator = $request->validate([
            'user_id'=>'required',
        ]);

        if ($validator) {
            $object = [
                'user_id'=>$request->user_id,
                'status'=>0,
                'total'=>0,
            ];
            $order = Order::create($object);
            return redirect()->route('admin.order.detail',['order'=>$order->id]);
        }else {
            return redirect()->back()->withErrors($validator)->withInput();
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

    public function detail($id)
    {
        $data['user'] = User::get();
        $data['product'] = Product::get();
        $data['edit'] = Order::findorfail($id);
        $data['items'] = OrderDetail::with('product')->where('order_id',$id)->get();
        $data['page_title']='Add Items';
        $data['edit_mode']=true;
        return view('admin.pages.orders.detail',$data);
    }

    public function add_item(Request $request, $id)
    {
        $validator = $request->validate([
            'product_id'=>'required',
            'quantity'=>'required',
        ]);
        if ($validator) {
            $order = Order::findorfail($id);
            $product = Product::findorfail($request->product_id);
            if ($product->product_stock>=$request->quantity) {
                DB::transaction(function() use ($id, $request,$order,$product) {
                    $object = [
                        'product_id'=>$request->product_id,
                        'quantity'=>$request->quantity,
                        'order_id'=>$order->id,
                        'subtotal'=>($product->product_price*$request->quantity),
                    ];
                    OrderDetail::create($object);
                    $items = OrderDetail::where('order_id',$order->id)->get(); 
                    $product->update(['product_stock'=>$product->product_stock - $request->quantity]);
                    $total = $items->sum('subtotal'); 
                    $order->update(['total'=>$total]);
                });
                return redirect()->route('admin.order.detail',['order'=>$order->id]); 
            }else{
                return redirect()->back()->with(['notif_status' => '0', 'notif' => 'Your quantity is over stock'])->withInput();
            }
        }else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function remove_item($id)
    {
        
        return'remove item';
    }

    public function process_order($id)
    {
        $order = Order::findorfail($id);
        $object['status'] = 2;
        $object['invoice'] = 'INV/'.date("Ymd").'/'.$order->id.'/'.time(); 
        $order->update($object);
        return redirect()->route('admin.order.index');
    }

    public function complete_order($id)
    {
        $order = Order::findorfail($id);
        $object['status'] = 1;
        $order->update($object);
        return redirect()->route('admin.order.index');
    }
}
