<?php

namespace App\Http\Controllers;

use App\Helpers\DBHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function login()
    {

        error_log("База данных Oracle недоступна!", 0);

        $user = User::where('email','test@test')->first();

        if(!$user) {
            $user = User::factory([
                'name' => 'Test',
                'email' => 'test@test',
                'avatar' => '/img/test.png',
                'role' => User::ROLE_ROOT
            ])->create();
        }

        auth()->login($user,true);

        //dd(auth()->user(), auth()->check());
        if (!request()->session()->get('key')) {
            session(['key' => 'value']);
        } else {
            request()->session()->get('key');
        };



        return redirect()->intended("/");
    }

    public function test(Request $request)
    {
        DBHelper::fresh('Алло премиум', 'основной');
    }
}
