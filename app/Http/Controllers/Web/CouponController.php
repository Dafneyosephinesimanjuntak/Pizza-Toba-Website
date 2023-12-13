<?php

namespace App\Http\Controllers\Web;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $keyword = $request->keyword;
            $coupons = Coupon::where('user_id', Auth::guard('web')->user()->id)
                ->where('code', 'like', '%'.$keyword.'%')
                ->orWhere('limit', 'like', '%'.$keyword.'%')
                ->where('user_id', Auth::guard('web')->user()->id)
                ->orWhere('used', 'like', '%'.$keyword.'%')
                ->where('user_id', Auth::guard('web')->user()->id)
                ->where('discount', 'like', '%'.$keyword.'%')
                ->where('user_id', Auth::guard('web')->user()->id)
                ->orderBy('id', 'desc')
                ->paginate(10);
            return view('pages.web.coupon.list', compact('coupons'));
        }
        return view('pages.web.coupon.main');
    }
}
