<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'tel' => 'required|string|max:30|unique:users,phone',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            Session::flash('notyf', ['type' => 'error', 'message' => 'Ошибка валидации. Пожалуйста, проверьте данные.']);

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->input('name'),
            'surname' => $request->input('firstname'),
            'phone' => $request->input('tel'),
            'password' => Hash::make($request->input('password')),
        ]);

        Auth::login($user);

        Session::flash('notyf', ['type' => 'success', 'message' => 'Вы успешно зарегистрированы и вошли в личный кабинет!']);

        return redirect()->route('account');
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tel' => 'required|string|max:20',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            Session::flash('notyf', ['type' => 'error', 'message' => 'Ошибка валидации. Пожалуйста, проверьте данные.']);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::where('phone', $request->input('tel'))->first();

        if ($user && Auth::attempt(['phone' => $request->input('tel'), 'password' => $request->input('password')], true)) {
            if ($user->role == 'admin') {

                Session::flash('notyf', ['type' => 'success', 'message' => 'Добро пожаловать, Админ! Вы успешно вошли в панель управления.']);
                return redirect()->route('admin');
            } else {
                Session::flash('notyf', ['type' => 'success', 'message' => 'Добро пожаловать! Вы успешно вошли в личный кабинет.']);
                return redirect()->route('account');
            }
        }

        Session::flash('notyf', ['type' => 'error', 'message' => 'Неверный номер телефона или пароль.']);
        return back()->withErrors([
            'tel' => 'Неверный номер телефона или пароль.',
        ]);
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Session::flash('notyf', ['type' => 'success', 'message' => 'Вы успешно вышли из личного кабинета.']);

        return redirect('/');
    }


}
