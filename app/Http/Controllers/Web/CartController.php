<?php

namespace App\Http\Controllers\Web;;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\Size;
use App\Models\Coupon;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function notif()
    {
        $subtotal = 0;
        $total = 0;
        $output = '';
        $cart = Cart::where('user_id', Auth::guard('web')->user()->id)->get();
        if ($cart->count() > 0) {
            $subtotal = 0;
            $total = 0;
            $subs = 0;

            foreach ($cart as $c) {
                $subs = $c->menu->price * $c->size->count / 100;
                $subtotal = $c->menu->price + $subs;
                $output .=
                    '<div class="d-block dropdown-item dropdown-item-cart text-wrap px-3 py-2">
                    <div class="d-flex align-items-center">
                        <img src="' . asset('images/img/' . $c->menu->image) . '" class="me-3 rounded-circle avatar-sm p-2 bg-light" alt="user-pic">
                        <div class="flex-1">
                            <h6 class="mt-0 mb-1 fs-14">
                                <a href="javascript" class="text-reset">' . $c->menu->name . '</a>
                            </h6>
                            <p class="mb-0 fs-12 text-muted text-nowrap">
                                Quantity: <span>' . $c->quantity . ' x Rp.' . number_format($subtotal,2,'.', ',') . '</span>
                            </p>
                            <p class="mb-0 fs-12 text-muted">
                                Size: <span>' . $c->size->size .'</span>
                            </p>
                        </div>
                        <div class="px-2">
                            <h5 class="m-0 fw-normal text-nowrap">Rp. <span class="cart-item-price">' . number_format($subtotal * $c->quantity,2,'.', ',') . '</span></h5>
                        </div>
                        <div class="ps-2">
                            <a href="javascript:;" onclick="remove_cart(\'Apakah Anda Yakin?\' , \'Yakin\',\'Tidak\' , \'DELETE\' , \'' . route('web.cart.delete', $c->id) . '\');" class="btn btn-icon btn-sm btn-ghost-secondary remove-item-btn"><i class="ri-close-fill fs-16"></i></a>
                        </div>
                    </div>
                </div>';
                $total = $total + ($subtotal * $c->quantity);
            }
        } else {
            $output .=
                '<div class="text-center empty-cart" id="empty-cart" style="display: none;">
                <div class="avatar-md mx-auto my-3">
                    <div class="avatar-title bg-soft-info text-info fs-36 rounded-circle">
                        <i class="bx bx-cart"></i>
                    </div>
                </div>
                <h5 class="mb-3">Your Cart is Empty!</h5>
                <a href="#" class="btn btn-success w-md mb-3">Shop Now</a>
            </div>';
        }
        return response()->json([
            'collection' => $output,
            'subtotal' => number_format($subtotal,2,'.', ','),
            'total' => number_format($total,2,'.', ','),
            'total_item' => $cart->count(),
        ]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $provinces = Province::all();
            $count = Cart::where('user_id', Auth::guard('web')->user()->id)->count();
            $carts = Cart::where('user_id', Auth::guard('web')->user()->id)->get();
            $size = Size::all();
            return view('pages.web.cart.list', compact('carts', 'count', 'provinces', 'size'));
        }
        return view('pages.web.cart.main');
    }

    public function store(Request $request)
    {                
        $cart = Cart::where('user_id', Auth::guard('web')->user()->id)->where('menu_id', $request->menu_id)->where('size_id', $request->size_id)->first();
        $menu = Menu::find($request->menu_id);
        
        // dd($menu);
        
        // dd($cart);
        
        if ($cart) {
            $quantity = $cart->quantity + $request->quantity;
            if($menu->stock < $quantity){
                return response()->json([
                    'alert' => 'error',
                    'message' => 'Stok tidak cukup!',
                ]);
            }
            $cart->quantity = $cart->quantity + $request->quantity;
            $cart->save();
        } else {
            if($menu->stock < $request->quantity){
                return response()->json([
                    'alert' => 'error',
                    'message' => 'Stok tidak cukup!',
                ]);
            }
            $cart = new Cart();
            $cart->user_id = Auth::guard('web')->user()->id;
            $cart->size_id = $request->size_id;
            $cart->menu_id = $request->menu_id;
            $cart->quantity = $request->quantity;
            $cart->save();
        }
        
        return response()->json([
            'alert' => 'success',
            'message' => 'Berhasil menambahkan ke keranjang',
        ]);
    }

    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'quantity' => 'required',
        ]);
        if ($cart->quantity < $cart->menu->stock) {
            $cart->quantity = $request->quantity;
            $cart->save();
            return response()->json([
                'quantity' => $cart->quantity,
                'subtotal' => number_format($request->quantity * $cart->menu->price),
            ]);
        } else {
            return response()->json([
                'quantity' => $cart->quantity,
                'subtotal' => number_format($cart->quantity * $cart->menu->price),
            ]);
        }
    }

    public function increase(Cart $cart)
    {
        if ($cart->quantity < $cart->menu->stock) {
            $cart->quantity = $cart->quantity + 1;
            $cart->update();
            return response()->json([
                'alert' => 'success',
                'message' => 'Berhasil menambahkan stok',
                'quantity' => $cart->quantity,
                'subtotal' => number_format($cart->quantity * $cart->menu->price),
            ]);

        } else {
            return response()->json([
                'alert' => 'error',
                'message' => 'Stok tidak mencukupi',
                'quantity' => $cart->quantity,
                'subtotal' => number_format($cart->quantity * $cart->menu->price),
            ]);
        }
    }

    public function decrease(Cart $cart)
    {
        if ($cart->quantity > 1) {
            $cart->quantity = $cart->quantity - 1;
            $cart->update();
            return response()->json([
                'alert' => 'success',
                'message' => 'Berhasil mengurangi jumlah pesanan',
                'quantity' => $cart->quantity,
                'subtotal' => number_format($cart->quantity * $cart->menu->price),
            ]);
        } else {
            return response()->json([
                'alert' => 'error',
                'message' => 'Stok tidak boleh kurang dari 1',
                'quantity' => $cart->quantity,
                'subtotal' => number_format($cart->quantity * $cart->menu->price),
            ]);
        }
    }
    public function destroy(Cart $cart)
    {
        $cart->delete();
        $count = Cart::where('user_id', Auth::guard('web')->user()->id)->count();
        return response()->json([
            'alert' => 'success',
            'total_item' => $count,
            'message' => 'Berhasil menghapus dari keranjang',
        ]);
    }
}
