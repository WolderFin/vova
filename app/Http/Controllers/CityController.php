<?php

namespace App\Http\Controllers;

use App\Models\Sity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CityController extends Controller
{
    public function sities()
    {
        // Получаем все города из базы данных
        $cities = Sity::all();

        // Возвращаем данные в формате JSON
        return response()->json($cities);
    }


    public function delete($id)
    {
        $city = Sity::find($id);

        if ($city) {
            $city->delete(); // Удаляем город
            Session::flash('notyf', ['type' => 'success', 'message' => 'Город успешно удален.']);
            return redirect()->route('admin');
        }

        Session::flash('notyf', ['type' => 'error', 'message' => 'Город не найден.']);
        return redirect()->route('admin');
    }

    public function update(Request $request, $id)
    {
        // Находим город по ID
        $city = Sity::find($id);

        if (!$city) {
            return redirect()->route('admin')->with('error', 'Город не найден');
        }

        // Валидируем данные
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'in_city' => 'required|string|max:255',  // Добавлено поле для города
            'url' => 'required|string|max:255', // Добавлено поле для URL
        ]);

        // Обновляем город
        $city->name = $validated['name'];
        $city->in_city = $validated['in_city']; // Обновляем поле in_city
        $city->url = $validated['url']; // Обновляем поле url
        $city->save();

        // Уведомление об успешном обновлении
        Session::flash('notyf', ['type' => 'success', 'message' => 'Город успешно обновлен!']);

        // Возвращаем на страницу администратора с уведомлением
        return redirect()->route('admin');
    }

    public function create(Request $request)
    {
        // Валидация данных
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'in_city' => 'required|string|max:255', // Добавлено поле
            'url' => 'required|string|max:255', // Добавлено поле
        ]);

        try {
            // Создание нового города
            $city = new Sity();
            $city->name = $validated['name'];
            $city->in_city = $validated['in_city']; // Добавляем новое поле
            $city->url = $validated['url']; // Добавляем новое поле
            $city->save();

            // Уведомление об успешном добавлении
            Session::flash('notyf', ['type' => 'success', 'message' => 'Город успешно добавлен!']);

            return redirect()->route('admin');
        } catch (\Exception $e) {
            // Уведомление об ошибке
            Session::flash('notyf', ['type' => 'error', 'message' => 'Ошибка при добавлении города.']);

            return redirect()->route('admin');
        }
    }

}
