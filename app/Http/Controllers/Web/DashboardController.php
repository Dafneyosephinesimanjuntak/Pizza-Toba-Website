<?php

namespace App\Http\Controllers\Web;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $menu = Menu::where('nama', 'like', '%' . $request->keyword . '%')->inRandomOrder()->get();
            return view('pages.web.dashboard.list', compact('menu'));
        }
        return view('pages.web.dashboard.main');
    }
}
