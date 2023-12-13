<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $menu = Menu::where('nama', 'like', '%' . $request->keyword . '%')
                ->latest()->paginate(10);
            return view('pages.admin.menu.list', compact('menu'));
        }
        return view('pages.admin.menu.main');
    }

    public function create()
    {
        return view('pages.admin.menu.input', ['data' => new Menu]);
    }

    public function store(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validators->fails()) {
            $errors = $validators->errors();
            if ($errors->has('nama')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('nama'),
                ]);        
            } elseif ($errors->has('category')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('category'),
                ]);
            } elseif ($errors->has('description')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('description'),
                ]);
            } elseif ($errors->has('price')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('price'),
                ]);
            } elseif ($errors->has('stock')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('stock'),
                ]);            
            } elseif ($errors->has('image')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('image'),
                ]);
            }
        }

        $file = $request->file('image');
        $filename = $file->getClientOriginalName();
        $file->move('images/img', $filename);

        Menu::create([
            'nama' => $request->nama,
            'category' => $request->category,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $filename,
        ]);

        return response()->json([
            'alert' => 'success',
            'message' => 'Berhasil menambahkan Menu baru',
        ]);
    }

    public function show(menu $menu)
    {
        return view('pages.admin.menu.show', ['data' => $menu]);
    }

    public function edit(menu $menu)
    {
        return view('pages.admin.menu.input', ['data' => $menu]);
    }

    public function update(Request $request, menu $menu)
    {
        $validators = Validator::make($request->all(), [
            'nama' => 'required|string|max:255' . $menu->id,            
            'category' => 'required',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validators->fails()) {
            $errors = $validators->errors();
            if ($errors->has('nama')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('nama'),
                ]);
            } elseif ($errors->has('category')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('category'),
                ]);
            } elseif ($errors->has('description')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('description'),
                ]);
            } elseif ($errors->has('price')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('price'),
                ]);
            } elseif ($errors->has('stock')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('stock'),
                ]);
            } elseif ($errors->has('image')) {
                return response()->json([
                    'alert' => 'error',
                ]);
            }
        }

        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move('images/img', $filename);
            
            $menu->update([
                'nama' => $request->nama,
                'category' => $request->category,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock,
                'image' => $filename,
            ]);
        }else{
            $menu->update([
                'nama' => $request->nama,
                'category' => $request->category,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock,                
            ]);
        }
        return response()->json([
            'alert' => 'success',
            'message' => 'Menu berhasil di Update!',
        ]);

    }

    public function destroy(menu $menu)
    {
        $file = public_path('images/img/' . $menu->image);
        if (file_exists($file)) {
            unlink($file);
        }

        $menu->delete();

        return response()->json([
            'alert' => 'success',
            'message' => 'Berhasil menghapus Menu',
        ]);
    }
}
