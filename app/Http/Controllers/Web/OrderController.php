<?php

namespace App\Http\Controllers\Web;

use App\Models\Order;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $orders = Order::where('user_id', auth()->guard('web')->user()->id)->latest()->paginate(10);
            $orders = Order::where('user_id', auth()->guard('web')->user()->id)
                            ->Where('total', 'like', '%' . $request->keyword . '%')
                            ->orWhere('status', 'like', '%' . $request->keyword . '%')
                            ->orWhere('code', 'like', '%' . $request->keyword . '%')
                            ->orWhere('payment', 'like', '%' . $request->keyword . '%')
                            ->latest()->paginate(10);

            // dd($orders);
            return view('pages.web.orders.list', compact('orders'));
        }
        return view('pages.web.orders.main');
    }

    public function show(Order $order)
    {
        $coupons = Coupon::where('id', $order->coupon_id)->get();     
        return view('pages.web.orders.show', compact('order', 'coupons'));
    }
}
