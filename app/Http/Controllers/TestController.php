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
        $user = User::firstOrCreate([
            'name' => 'Test',
            'email' => 'test@test',
            'avatar' => '/img/test.png',
            'role' => User::ROLE_ROOT
        ]);

        Auth::loginUsingId($user->id);

        return redirect()->intended("/");
    }

    public function test(Request $request)
    {
        DBHelper::fresh('Алло премиум', 'основной');
    }
}
