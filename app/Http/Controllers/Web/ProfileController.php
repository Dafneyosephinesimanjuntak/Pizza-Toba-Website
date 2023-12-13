<?php

namespace App\Http\Controllers\Web;

use App\Models\City;
use App\Models\User;
use App\Models\Province;
use App\Models\Subdistrict;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{    
    public function index(Request $request)
    {  
       $provinces = Province::all();        
       $cities = City::all();
       $subdistricts = Subdistrict::all();     
       return view('pages.web.profile.main', compact('provinces', 'cities', 'subdistricts'));
    }

    public function update_profile(Request $request, User $user)
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
       
       
       return response()->json([
              'alert' => 'success',
              'message' => 'Profile updated!',
       ]);
      
       
    }
    
}
