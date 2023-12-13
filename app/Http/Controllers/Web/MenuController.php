<?php

namespace App\Http\Controllers\Web;

use App\Models\Menu;
use App\Models\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function makanan(Request $request)
    {
        if ($request->ajax()) {
            $menu = Menu::where('category', 'makanan')->where('nama', 'like', '%' . $request->keyword . '%')->paginate(4);
            return view('pages.web.menu.list', compact('menu'));
        }
        return view('pages.web.menu.main');
    }

    public function minuman(Request $request)
    {
        if ($request->ajax()) {
            $menu = Menu::where('category', 'minuman')->where('nama', 'like', '%' . $request->keyword . '%')->paginate(4);
            return view('pages.web.menu.list', compact('menu'));
        }
        return view('pages.web.menu.main');
    }


    public function show(Menu $menu)
    {
        $size = Size::all();
        return view('pages.web.menu.show', [
            'menu' => $menu,
            'size' => $size
        ]);
    }
}
