<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\Menu;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\OrderDetail;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {            
            $orders = Order::join('users', 'users.id' , '=', 'orders.user_id')
                            ->where('total', 'like', '%' . $request->keyword . '%')
                            ->orWhere('fullname', 'like', '%' . $request->keyword . '%')
                            ->orWhere('orders.created_at', 'like', '%' . $request->keyword . '%')                            
                            ->orWhere('status', 'like', '%' . $request->keyword . '%')
                            ->orWhere('payment', 'like', '%' . $request->keyword . '%')
                            ->select('users.*', 'orders.*')
                            ->latest('orders.created_at')->paginate(10);
            return view('pages.admin.orders.list', compact('orders'));
        }
        return view('pages.admin.orders.main');
    }

    public function show(Order $order)
    {
        $coupons = Coupon::where('id', $order->coupon_id)->get();    
        return view('pages.admin.orders.show', compact('order', 'coupons'));
    }

    public function accept(Order $order)
    {   
        if ($order->coupon_id) {
            $coupon = Coupon::find($order->coupon_id);
            $coupon->limit = $coupon->limit - 1;
            if ($coupon->limit == 0) {
                $coupon->used = 1;
            }

            $coupon->save();
        }
        $order->status = 'accepted';
        $order->save();
        
        $notification = new Notification;
        $notification->user_id = $order->user_id;
        $notification->message = 'Pesanan anda dengan kode ' .$order->code. ' Diterima!';
        $notification->type = 'success';
        $notification->save();
        

        return response()->json([
            'alert' => 'success',
            'message' => 'Pesanan berhasil Diterima',
        ]);
    }

    public function reject(Order $order)
    {
        $notification = new Notification;
        $notification->user_id = $order->user_id;
        $notification->message = 'Pesanan anda dengan kode ' .$order->code. ' Ditolak!';
        $notification->type = 'warning';
        $notification->save();

        $order->status = 'rejected';
        $order->save();
        $order_details = OrderDetail::where('order_id', $order->id)->get();
        foreach($order_details as $item){
            $menu = Menu::find($item->menu_id);
            $menu->stock = $menu->stock + $item->quantity;
            $menu->update();
        }
        
        return response()->json([
            'alert' => 'success',
            'message' => 'Pesanan berhasil ditolak',
        ]);
    }
    public function pdf()
    {       
        $now = Carbon::now()->translatedFormat('l, d F Y');
        $orders = Order::orderBy('created_at', 'DESC')->get();        
        $pdf = PDF::loadView('pages.admin.orders.pdf', ['orders' => $orders]);
        // return $pdf->stream();
        return $pdf->download($now.'.pdf');
    }
}
