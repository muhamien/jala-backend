<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\FacadesAuth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        @$order = Order::where('status',0)->where('user_id',Auth::user()->id)->latest()->limit(1)->first();
        // dd($order);
        $data['order']=$order;
        if ($order) {
            $order_detail = OrderDetail::with('product')->where('order_id',$order->id)->get();
            $data['cart'] = $order_detail;
        }else{
            $data['cart'] = [];
        }
        $product = Product::get();
        $data['data']=$product;
        return view('welcome',$data);
    }

    public function add_to_cart($id)
    {
        $order = Order::where('user_id',Auth::id())->latest()->limit(1)->get();
        $product = Product::findorfail($id);
        $order_detail = OrderDetail::where('order_id',$order[0]->id)->first();
        $cek_item = OrderDetail::where('product_id',$id)->where('order_id',$order_detail->order_id)->first();
        // dd($order[0]->total);
        if ($order[0]->status != 0) { 
            $order_data = [
                'status'=>0,
                'total'=>$product->product_price,
                'user_id'=>Auth::id(),
            ];
            $create_order = Order::create($order_data); 
            $item = [
                'order_id'=>$create_order->id,
                'product_id'=>$product->id,
                'subtotal'=>$product->product_price,
                'quantity'=>1,
            ];
            OrderDetail::create($item); 
            $product->update(['product_stock'=>$product->product_stock-1]);
        } else {
            $last_order = Order::findorfail($order[0]->id);
            if ($cek_item) { 
                $last_order->update(['total' => ($product->product_price + $order[0]->total)]);
                $item_detail = [ 
                    'quantity'=>$cek_item->quantity+1,
                ];
                OrderDetail::findorfail($cek_item->id)->update($item_detail);
            }else{
                $item_detail = [
                    'order_id'=>$last_order->id,
                    'product_id'=>$product->id,
                    'subtotal'=>$product->product_price,
                    'quantity'=>1,
                ];
                OrderDetail::create($item_detail);
            }
            $product->update(['product_stock'=>$product->product_stock-1]);
        }
        return redirect()->back()->with(['notif_status' => '1', 'notif' => 'Add item success.']);
    }

    public function remove_from_cart($id)
    {
        $order_detail = OrderDetail::findorfail($id);
        $order = Order::findorfail($order_detail->order_id);
        $product = Product::findorfail($order_detail->product_id);
        if ($order_detail->quantity <= 1) {
            $order->delete();
            $order_detail->delete();
        }else{
            $order_detail->update(['quantity'=>$order_detail->quantity - 1]);
            $order->update(['total'=>$order->total - $product->product_price]);
            $product->update(['product_stock'=>$product->product_stock + 1]);
        } 
        return redirect()->back()->with(['notif_status' => '1', 'notif' => 'Remove item success.']);
    }
    
    public function checkout()
    {
        @$order = Order::where('status',0)->where('user_id',Auth::user()->id)->latest()->limit(1)->first();
        // dd($order);
        $data['order']=$order;
        if ($order) {
            $order_detail = OrderDetail::with('product')->where('order_id',$order->id)->get();
            // dd($order_detail);
            $data['cart'] = $order_detail;
        }else{
            $data['cart'] = [];
        }
        return view('checkout',$data);
    }

    public function order($id){
        Order::findorfail($id)->update(['status'=>3]);
        return redirect()->route('home')->with(['notif_status' => '1', 'notif' => 'Your order under review.']);
    }
    public function history($id){
        $order = Order::where('user_id',$id)->latest()->get();
        $data['data']=$order;
        return view('history',$data);
    }
}
