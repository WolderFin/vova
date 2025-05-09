<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\Sity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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

            $ads = Auth::user()->ads;

            return view('account', compact('ads'));
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

    public function update(Request $request, $id)
    {
        // Проверка аутентификации
        if (!Auth::check()) {
            return redirect()->route('login')->with('notyf', ['type' => 'error', 'message' => 'Пожалуйста, войдите в систему.']);
        }

        // Валидация данных
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'tel' => 'required|string|max:255',
            'password' => 'nullable|string|min:6',
        ]);

        // Найти пользователя по ID
        $user = User::find($id);

        // Если пользователь не найден, вернуть ошибку
        if (!$user) {
            return redirect()->back()->with('notyf', ['type' => 'error', 'message' => 'Пользователь не найден.']);
        }

        // Обновление данных пользователя
        $user->name = $validated['name'];
        $user->surname = $validated['surname'];
        $user->phone = $validated['tel'];

        // Если пароль был введен, хешируем его и сохраняем
        if ($request->has('password') && !empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        // Сохраняем изменения
        $user->save();

        // Уведомление об успешном обновлении
        Session::flash('notyf', ['type' => 'success', 'message' => 'Данные успешно обновлены.']);
        return redirect()->back();
    }


}
