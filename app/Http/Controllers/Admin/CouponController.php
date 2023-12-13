<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupon;
use App\Helpers\Helper;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $keyword = $request->keyword;
            $coupons = Coupon::join('users', 'users.id', '=', 'coupons.user_id')                
                ->where('code', 'like', '%'.$keyword.'%')
                ->orWhere('fullname', 'like', '%'.$keyword.'%')
                ->orWhere('discount', 'like', '%'.$keyword.'%')
                ->orderBy('coupons.id', 'desc')
                ->paginate(10);
            return view('pages.admin.coupon.list', compact('coupons'));
        }
        return view('pages.admin.coupon.main');
    }

    public function create(Request $request)
    {
        $customers = User::where('role', 'user')
                    ->join('orders', 'orders.user_id', '=', 'users.id')
                    ->join('order_details', 'order_details.order_id', '=', 'orders.id')
                    ->select(['users.id', 'users.fullname'])
                    ->havingRaw('COUNT(order_details.id)>=2')
                    ->groupBy('users.id')
                    ->get();
        
        return view('pages.admin.coupon.input', ['data' => new  Coupon, 'customers' => $customers]);
    }
    public function store(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'discount' => 'required|integer|min:1',
        ]);

        if ($validators->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validators->errors()->first(),
            ]);
        }
        $coupon = new Coupon;
        $coupon->code = Helper::generate_coupon_code();
        $coupon->user_id = $request->user_id;
        $coupon->discount = $request->discount;
        $coupon->limit = $request->limit;
        $coupon->save();

        $notification = new Notification;
        $notification->user_id = $request->user_id;
        $notification->message = 'Anda mendapatkan kode diskon sebesar ' . $request->discount . '%';
        $notification->type = 'info';
        $notification->save();

        return response()->json([
            'alert' => 'success',
            'message' => 'Coupon created',
        ]);
    }

    public function edit(Request $request, Coupon $coupon)
    {
        $customers = User::where('role', 'user')
        ->join('orders', 'orders.user_id', '=', 'users.id')
        ->join('order_details', 'order_details.order_id', '=', 'orders.id')
        ->select(['users.id', 'users.fullname'])
        ->havingRaw('COUNT(order_details.id)>=2')
        ->groupBy('users.id')
        ->get();
        return view('pages.admin.coupon.input', ['data' => $coupon, 'customers' => $customers]);
    }

    public function update(Request $request, Coupon $coupon)
    {
        $validators = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'discount' => 'required|integer|min:1',
        ]);

        if ($validators->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validators->errors()->first(),
            ]);
        }

        $coupon->user_id = $request->user_id;
        $coupon->discount = $request->discount;
        $coupon->save();

        return response()->json([
            'alert' => 'success',
            'message' => 'Coupon updated',
        ]);
    }

    public function destroy(Request $request, Coupon $coupon)
    {
        $coupon->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Coupon deleted',
        ]);
    }
}
