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

        $user = User::where('email','test@test')->first();

        if(!$user) {
            $user = User::factory([
                'name' => 'Test',
                'email' => 'test@test',
                'avatar' => '/img/test.png',
                'role' => USER::ROLE_ADMIN
            ])->create();
        }

        auth()->login($user,true);

        return redirect()->intended("/");
    }

}
