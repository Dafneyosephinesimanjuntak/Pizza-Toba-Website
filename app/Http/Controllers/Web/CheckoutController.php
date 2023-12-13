<?php

namespace App\Http\Controllers\Web;

use PDF;
use App\Models\Cart;
use App\Models\City;
use App\Models\Menu;
use App\Models\Size;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Helpers\Helper;
use App\Models\Province;
use App\Models\OrderDetail;
use App\Models\Subdistrict;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $quantities = DB::table('carts')->select('quantity', DB::raw('COUNT(quantity) as quantities'), 'menu_id', 'id', 'user_id')->groupBy('quantity', 'menu_id', 'id', 'user_id')->get();
        $carts = Cart::where('user_id', Auth::guard('web')->user()->id)->get();
        $provinces = Province::all();        
        $cities = City::all();
        $size = Size::all();
        $subdistricts = Subdistrict::all();     
        $coupon = Coupon::where('user_id', Auth::user()->id)->get();
        // dd($carts);
        return view('pages.web.checkout.main', compact('carts', 'coupon', 'provinces', 'cities', 'subdistricts', 'size'));       
        
    }

    public function check_coupon(Request $request){
        $coupon = Coupon::where('code', $request->coupon)->first();
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        $total = 0;
        foreach($carts as $c){
            $subs = $c->menu->price * $c->size->count / 100;
            $subtotal = $c->menu->price + $subs;
            $total = $total + ($subtotal * $c->quantity);
        }

        if ($coupon && $coupon->limit != 0 ) {            

            $discount = $total * $coupon->discount / 100;
            $price = $total - $discount;
            $coupon->save();
            return response()->json([
                'alert' => 'success',
                'message' => 'Kupon berhasil digunakan!',
                'coupon' => $coupon->id,
                'total' => number_format($price,2,'.', ','),                
                'discount' => $coupon->discount,
                'total_discount' => $discount,
            ]);
        
        } else if(!$coupon){
            return response()->json([
                'alert' => 'danger',
                'message' => 'Coupon code is not valid',
            ]);
        } else {
            return response()->json([
                'alert' => 'danger',
                'message' => 'Coupon code is limit',
            ]);
        }
    }


    public function check(Request $request){
        if($request->payment != 'Cash'){
            $validators = Validator::make($request->all(), [
                'fullname' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'province' => 'required',
                'city' => 'required',
                'subdistrict' => 'required',
                'postal_code' => 'required',
                'payment' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        }else{
            $validators = Validator::make($request->all(), [
                'fullname' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'province' => 'required',
                'city' => 'required',
                'subdistrict' => 'required',
                'postal_code' => 'required',
                'payment' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);            
        }
        if ($validators->fails()) {
            $errors = $validators->errors();
            if ($errors->has('fullname')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('fullname'),
                ]);
            }
            if ($errors->has('phone')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('phone'),
                ]);
            }
            if ($errors->has('address')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('address'),
                ]);
            }
            if ($errors->has('province')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('province'),
                ]);
            }
            if ($errors->has('card_id')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('card_id'),
                ]);
            }
            if ($errors->has('card_name')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('card_name'),
                ]);
            }
            if ($errors->has('city')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('city'),
                ]);
            }
            if ($errors->has('subdistrict')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('subdistrict'),
                ]);
            }
            if ($errors->has('postal_code')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('postal_code'),
                ]);
            }
            if ($errors->has('payment')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => 'Silahkan pilih cara pembayaran',
                ]);
            }
            if ($errors->has('image')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => 'Silahkan upload bukti pembayaran',
                ]);
            }
        }

        return response()->json([
            'alert' => 'success',
        ]);
    }

    public function checkout(Request $request)
    {        
        $user = User::find(Auth::guard('web')->user()->id);
        $user->fullname = $request->fullname;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->card_name = $request->card_name;
        $user->card_id = $request->card_id;
        $user->province_id = $request->province;
        $user->city_id = $request->city;
        $user->subdistrict_id = $request->subdistrict;
        $user->postal_code = $request->postal_code;
        $user->save();

        
        $cart = Cart::where('user_id', Auth::guard('web')->user()->id)->get();
        $total = 0;
        $subs = 0;
        $subtotal = 0;
        
        foreach ($cart as $c) {
            $subs = $c->menu->price * $c->size->count / 100;
            $subtotal = $c->menu->price + $subs;
            $total = $total + ($subtotal * $c->quantity);
        }
        if($request->payment != 'Cash'){
            $order = new Order();
            $order->code = Helper::IDGenerator();
            $order->user_id = Auth::guard('web')->user()->id;
            $order->total = $total;
            $order->coupon_id = $request->coupon_id;
            $order->payment = $request->payment;
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/bukti_pembayaran'), $filename);
            $order->image = $filename;
            $order->save();
            $cart = Cart::where('user_id', Auth::guard('web')->user()->id)->get();
            foreach ($cart as $c) {
                $order_detail = new OrderDetail;
                $order_detail->order_id = $order->id;
                $order_detail->menu_id = $c->menu_id;
                $order_detail->size_id = $c->size_id;
                $order_detail->quantity = $c->quantity;
                $order_detail->save();
                $menu = Menu::find($c->menu_id);
                $menu->stock = $menu->stock - $c->quantity;
                $menu->update();
            }

        }else{
            $order = new Order();
            $order->code = Helper::IDGenerator();
            $order->user_id = Auth::guard('web')->user()->id;
            $order->total = $total;
            $order->coupon_id = $request->coupon_id;
            $order->payment = $request->payment;            
            $order->save();
            $cart = Cart::where('user_id', Auth::guard('web')->user()->id)->get();
            foreach ($cart as $c) {
                $order_detail = new OrderDetail;
                $order_detail->order_id = $order->id;
                $order_detail->menu_id = $c->menu_id;
                $order_detail->size_id = $c->size_id;
                $order_detail->quantity = $c->quantity;
                $order_detail->save();
                $menu = Menu::find($c->menu_id);
                $menu->stock = $menu->stock - $c->quantity;
                $menu->update();
            }
        }
        $notification = new Notification;
        $notification->user_id = 1;
        $notification->message = 'Anda mendapatkan Pesanan! Kode ' .$order->code;
        $notification->type = 'success';
        $notification->save();
        Cart::where('user_id', Auth::user()->id)->delete();
        
        return view('pages.web.checkout.detail', ['order' => $order]);
    }
    public function pdf(Order $order)
    {
        $coupons = Coupon::where('id', $order->coupon_id)->get();        
        $pdf = PDF::loadView('pages.web.checkout.pdf', [
            'order' => $order,
            'coupons' => $coupons
        ]);
        // return $pdf->stream();
        return $pdf->download($order->code. ' - ' .$order->created_at->format('d-m-Y') . '.pdf');
    }
}
