<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\Sity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(Request $request){
        $query = Ad::with(['user', 'category', 'city']) // Загружаем связи сразу
        ->where('status', 'Размещено');

        // Фильтр по категории — по GET параметру, например: ?car
        $categoryKey = collect($request->query())->keys()->first(); // ?car
        if ($categoryKey) {
            $category = Category::where('url', $categoryKey)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }
        $selectedCity = $_COOKIE['selectedCity'] ?? null;
        if ($selectedCity) {
            $city = Sity::where('name', $selectedCity)->first(); // или slug, если есть
            if ($city) {
                $query->where('city_id', $city->id);
            }
        }

        $ads = $query->get();

        return view('index', compact('ads'));
    }
    public function redirect(){
        $user = Auth::user();
        if (Auth::check()) {
            if ($user->role == 'admin') {
                return redirect()->route('admin');
            }
            if ($user->role == 'user') {
                return redirect()->route('account');
            }
        }
        else{
            return redirect()->route('home');
        }
    }
    public function search(Request $request){
        $query = Ad::query();

        // Только активные объявления
        $query->where('status', 'Размещено');

        // Если есть поисковый запрос
        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $ads = $query->get();

        return view('search', [
            'ads' => $ads,
            'request' => $request->all()
        ]);
    }
    public function admin(){
        $cities = Sity::all();
        if (Auth::user()->role === 'admin') {
            return view('admin', compact('cities'));
        }
        else{
            return $this->redirect();
        }
    }
    public function account(){
        if (Auth::user()->role === 'user') {
            return view('account');
        }
        else{
            return $this->redirect();
        }
    }
    public function ad($slug){
        $ad = Ad::where('url', $slug)
            ->where('status', 'Размещено')
            ->firstOrFail();
        $ad_similar = Ad::where('category_id', $ad->category_id)->where('id', '!=', $ad->id)->where('status', 'Размещено')->get();
        return view('ad', compact('ad', 'ad_similar'));
    }
}
