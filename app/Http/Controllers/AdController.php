<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\Sity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AdController extends Controller
{
    public function ads(){

        $ads = Ad::all();

        return view('admin.ads', compact('ads'));

    }

    public function delete($id)
    {
        // Находим объявление по ID
        $ad = Ad::find($id);

        // Проверяем, существует ли объявление
        if ($ad) {
            // Удаляем объявление
            $ad->delete();

            // Уведомление об успешном удалении
            Session::flash('notyf', ['type' => 'success', 'message' => 'Объявление успешно удалено.']);

            // Перенаправляем обратно на страницу с объявлениями
            return redirect()->back();
        }

        // Если объявление не найдено, возвращаем ошибку
        Session::flash('notyf', ['type' => 'error', 'message' => 'Объявление не найдено.']);

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $ad = Ad::find($id);

        if (!$ad) {
            // Уведомление о том, что объявление не найдено
            Session::flash('notyf', ['type' => 'error', 'message' => 'Объявление не найдено!']);
            return redirect()->route('ads.index');
        }

        // Валидируем данные
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'city_id' => 'required',
            'category_id' => 'required',
            'status' => 'required',
        ]);

        // Обновляем объявление
        $ad->name = $validated['name'];
        $ad->price = $validated['price'];
        $ad->description = $validated['description'];
        $ad->city_id = $validated['city_id'];
        $ad->category_id = $validated['category_id'];
        $ad->status = $validated['status'];
        $ad->save();

        // Уведомление об успешном обновлении
        Session::flash('notyf', ['type' => 'success', 'message' => 'Объявление успешно обновлено!']);

        return redirect()->back();
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'required|string',
            'price' => 'required|string',
            'city_id' => 'required|exists:sities,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $imagePath = $request->file('photo')->store('ads', 'public');
        $ad = Ad::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'image' => $imagePath,
            'user_id' => auth()->id(),
            'category_id' => $validated['category_id'],
            'city_id' => $validated['city_id'],
            'url' => Str::slug($validated['name']) . '-' . Str::random(6),
            'status' => 'На модерации',
        ]);

        Session::flash('notyf', ['type' => 'success', 'message' => 'Объявление создано и отправлено на модерацию']);
        return redirect()->back();
    }
}
