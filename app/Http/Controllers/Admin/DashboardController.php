<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::where('role', '=', 'user')->get();
        $total_user = User::where('role', '=', 'user')->count();
        $total_order = Order::where('status', '=', 'pending')->count();
        return view('pages.admin.dashboard.main', compact('total_user', 'total_order', 'users'));
    }
}
