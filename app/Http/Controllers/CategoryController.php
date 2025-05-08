<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Sity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function category(){

        $categories = Category::all();

        return view('admin.category', compact('categories'));
    }

    public function delete($id)
    {
        $category = Category::find($id);

        if ($category) {
            $category->delete(); // Удаляем категорию
            // Уведомление об успешном удалении
            Session::flash('notyf', ['type' => 'success', 'message' => 'Категория успешно удалена!']);
            return redirect()->route('category');
        }

        // Уведомление о том, что категория не найдена
        Session::flash('notyf', ['type' => 'error', 'message' => 'Категория не найдена!']);
        return redirect()->route('category');
    }



    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            // Уведомление о том, что категория не найдена
            Session::flash('notyf', ['type' => 'error', 'message' => 'Категория не найдена!']);
            return redirect()->route('category');
        }

        // Валидируем данные
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        // Обновляем категорию
        $category->name = $validated['name'];
        $category->url = $validated['url'];
        $category->description = $validated['description'];
        $category->save();

        // Уведомление об успешном обновлении
        Session::flash('notyf', ['type' => 'success', 'message' => 'Категория успешно обновлена!']);

        return redirect()->route('category');
    }

    public function create(Request $request)
    {
        // Валидируем данные
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        // Создаем новую категорию
        $category = new Category();
        $category->name = $validated['name'];
        $category->url = $validated['url'];
        $category->description = $validated['description'];
        $category->save();

        // Уведомление об успешном создании
        Session::flash('notyf', ['type' => 'success', 'message' => 'Категория успешно добавлена!']);

        // Перенаправляем обратно на страницу категорий
        return redirect()->route('category');
    }


}
