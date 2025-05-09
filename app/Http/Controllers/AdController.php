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
            return redirect()->route('ads');
        }

        // Если объявление не найдено, возвращаем ошибку
        Session::flash('notyf', ['type' => 'error', 'message' => 'Объявление не найдено.']);

        return redirect()->route('ads');
    }

    public function updateStatus(Request $request, $id)
    {
        // Находим объявление по ID
        $ad = Ad::find($id);

        if (!$ad) {
            return redirect()->route('ads')->with('error', 'Объявление не найдено');
        }

        // Валидация статуса
        $validated = $request->validate([
            'status' => 'required|string|in:Размещено,Отклонено,На модерации',
        ]);

        // Обновляем только статус
        $ad->status = $validated['status'];
        $ad->save();

        // Уведомление об успешном обновлении
        Session::flash('notyf', ['type' => 'success', 'message' => 'Статус объявления успешно обновлен!']);

        // Возвращаем на страницу с объявлениями
        return redirect()->route('ads');
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
