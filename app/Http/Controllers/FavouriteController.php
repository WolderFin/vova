<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FavouriteController extends Controller
{
    public function store(Request $request){
        if(Auth::check()){
            $user = Auth::user();
            $fav_check = Favourite::where('user_id', $user->id)->where('ad_id', $request['ad_id'])->first();
            $validate = request()->validate([
                'ad_id' => 'required|exists:ads,id',
            ]);
            if (!$fav_check) {
                Favourite::create([
                    'user_id' => $user->id,
                    'ad_id' => $validate['ad_id'],
                ]);
                Session::flash('notyf', ['type' => 'success', 'message' => 'Объявление добавлено в избранное']);
                return redirect()->back();
            }
            else{
                $fav_check->delete();
                Session::flash('notyf', ['type' => 'success', 'message' => 'Объявление удаленно из избранного']);
                return redirect()->back();
            }
        }
        return;
    }
}
